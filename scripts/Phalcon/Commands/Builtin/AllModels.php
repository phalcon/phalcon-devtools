<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file docs/LICENSE.txt.                        |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands\Builtin;

use Phalcon\Builder\AllModels as AllModelsBuilder;
use Phalcon\Builder;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Config;
use Phalcon\Commands\Command;
use Phalcon\Commands\CommandsException;

/**
 * AllModels Command
 *
 * Create all models from a database
 *
 * @package     Phalcon\Commands\Builtin
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class AllModels extends Command
{
    protected $_possibleParameters = array(
        'config=s'    => "Configuration file  ",
        'models=s'    => "Models directory ",
        'schema=s'    => "Name of the schema. [optional]",
        'namespace=s' => "Model's namespace [optional]",
        'extends=s'   => "Models extends [optional]",
        'force'       => "Force script to rewrite all the models.  ",
        'get-set'     => "Attributes will be protected and have setters/getters.  ",
        'doc'         => "Helps to improve code completion on IDEs  ",
        'relations'   => "Possible relations defined according to convention.  ",
        'fk'          => "Define any virtual foreign keys.  ",
        'validations' => "Define possible domain validation according to conventions.  ",
        'directory=s' => "Base path on which project will be created",
        'mapcolumn'   => 'Get some code for map columns. [optional]',
        'abstract'    => 'Abstract Model [optional]'
    );

    /**
     * Executes the command
     *
     * @param $parameters
     * @return void
     * @throws CommandsException
     */
    public function run($parameters)
    {
        if ($this->isReceivedOption('directory')) {
            if (false == $this->path->isAbsolutePath($this->getOption('directory'))) {
                $this->path->appendRootPath($this->getOption('directory'));
            } else {
                $this->path->setRootPath($this->getOption('directory'));
            }
        }

        if ($this->isReceivedOption('config')) {
            if (false == $this->path->isAbsolutePath($this->getOption('config'))) {
                $configPath = $this->path->getRootPath() . $this->getOption('config');
            } else {
                $configPath = $this->getOption('config');
            }

            if (preg_match('/.*(:?\.ini)(?:\s)?$/i', $configPath)) {
                $config = new ConfigIni($configPath);
            } else {
                $config = include $configPath;

                if (is_array($config)) {
                    $config = new Config($config);
                }
            }

        } else {
            $config = $this->path->getConfig();
        }

        if (!$this->isReceivedOption('models')) {
            if (!isset($config->application->modelsDir)) {
                throw new CommandsException("Builder doesn't know where is the models directory.");
            }
            $modelsDir = rtrim($config->application->modelsDir, '\\/') . DIRECTORY_SEPARATOR;
        } else {
            $modelsDir = $this->getOption('models');
        }

        if (false == $this->path->isAbsolutePath($modelsDir)) {
            $modelsDir = $this->path->getRootPath($modelsDir);
        }

        $modelBuilder = new AllModelsBuilder(array(
            'force' => $this->isReceivedOption('force'),
            'config' => $config,
            'schema' => $this->getOption('schema'),
            'extends' => $this->getOption('extends'),
            'namespace' => $this->getOption('namespace'),
            'directory' => $this->getOption('directory'),
            'foreignKeys' => $this->isReceivedOption('fk'),
            'defineRelations' => $this->isReceivedOption('relations'),
            'genSettersGetters' => $this->isReceivedOption('get-set'),
            'genDocMethods' => $this->isReceivedOption('doc'),
            'modelsDir' => $modelsDir,
            'mapColumn' => $this->isReceivedOption('mapcolumn'),
            'abstract' => $this->isReceivedOption('abstract')
        ));

        $modelBuilder->build();
    }

    /**
     * Returns the commands provided by the command
     *
     * @return array
     */
    public function getCommands()
    {
        return array('all-models', 'create-all-models');
    }

    /**
     * Checks whether the command can be executed outside a Phalcon project
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return false;
    }

    /**
     * Prints the help for current command.
     *
     * @return void
     */
    public function getHelp()
    {
        $this->printParameters($this->_possibleParameters);
    }

    /**
     * Returns number of required parameters for this command
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 0;
    }
}
