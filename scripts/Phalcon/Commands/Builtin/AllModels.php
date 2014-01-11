<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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

use Phalcon\Text;
use Phalcon\Builder;
use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Commands\CommandsInterface;

/**
 * AllModels
 *
 * Create all models from a database
 *
 * @category 	Phalcon
 * @package 	Commands
 * @subpackage  Builtin
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class AllModels extends Command implements CommandsInterface
{

    protected $_possibleParameters = array(
        'config=s' 			=> "Configuration file  ",
        'models=s' 			=> "Models directory ",
        'schema=s'        	=> "Name of the schema. [optional]",
        'namespace=s'       => "Model's namespace [optional]",
        'extends=s'         => "Models extends [optional]",
        'force'				=> "Force script to rewrite all the models.  ",
        'get-set' 			=> "Attributes will be protected and have setters/getters.  ",
        'doc' 				=> "Helps to improve code completion on IDEs  ",
        'relations' 		=> "Possible relations defined according to convention.  ",
        'fk' 				=> "Define any virtual foreign keys.  ",
        'validations' 		=> "Define possible domain validation according to conventions.  ",
        'directory=s' 		=> "Base path on which project will be created",
    );

    /**
     * @param $parameters
     */
    public function run($parameters)
    {

        $path = '';
        if ($this->isReceivedOption('directory')) {
            $path = $this->getOption('directory') . '/';
        }

        $config = null;
        if (!$this->isReceivedOption('models')) {

            $fileType = file_exists($path . "app/config/config.ini") ? "ini" : "php";

            if ($this->isReceivedOption('config')) {
                $configPath = $path.$this->getOption('config')."/config.".$fileType;
            } else {
                $configPath = $path."app/config/config." . $fileType;
            }

            if ($fileType == 'ini') {
                $config = new \Phalcon\Config\Adapter\Ini($configPath);
            } else {
                $config = include $configPath;
            }

            if (file_exists($path.'public')) {
                $modelsDir = 'public/'.$config->application->modelsDir;
            } else {
                $modelsDir = $config->application->modelsDir;
            }
        } else {
            $modelsDir = $this->getOption('models');
        }

        $modelBuilder = new \Phalcon\Builder\AllModels(array(
            'force' => $this->isReceivedOption('force'),
            'config' => $config,
            'schema' => $this->getOption('schema'),
            'extends' => $this->getOption('extends'),
            'namespace' => $this->getOption('namespace'),
            'directory' => $this->getOption('directory'),
            'foreignKeys' => $this->isReceivedOption('fk'),
            'defineRelations' => $this->isReceivedOption('relations'),
            'genSettersGetters' => $this->isReceivedOption('get-set'),
            'genDocMethods' => $this->isReceivedOption('doc')
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
     * @return int
     */
    public function getRequiredParams()
    {
        return 0;
    }

}
