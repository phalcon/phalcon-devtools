<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Commands\Builtin;

use Phalcon\Config\Config;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\DevTools\Builder\Component\AllModels as AllModelsBuilder;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Commands\CommandsException;

/**
 * AllModels Command
 *
 * Create all models from a database
 */
class AllModels extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'config=s'    => 'Configuration file [optional]',
            'schema=s'    => 'Name of the schema. [optional]',
            'namespace=s' => "Model's namespace [optional]",
            'extends=s'   => 'Models extends [optional]',
            'force'       => 'Force script to rewrite all the models [optional]',
            'camelize'    => 'Properties is in camelCase [optional]',
            'get-set'     => 'Attributes will be protected and have setters/getters [optional]',
            'doc'         => 'Helps to improve code completion on IDEs [optional]',
            'relations'   => 'Possible relations defined according to convention [optional]',
            'fk'          => 'Define any virtual foreign keys [optional]',
            'directory=s' => 'Base path on which project will be created [optional]',
            'output=s'    => 'Folder where models are located [optional]',
            'mapcolumn'   => 'Get some code for map columns [optional]',
            'abstract'    => 'Abstract Model [optional]',
            'annotate'    => 'Annotate Attributes [optional]',
            'help'        => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @throws CommandsException
     * @throws BuilderException
     */
    public function run(array $parameters): void
    {
        if ($this->isReceivedOption('directory')) {
            if (!$this->path->isAbsolutePath($this->getOption('directory'))) {
                $this->path->appendRootPath($this->getOption('directory'));
            } else {
                $this->path->setRootPath($this->getOption('directory'));
            }
        }

        if ($this->isReceivedOption('config')) {
            if (!$this->path->isAbsolutePath($this->getOption('config'))) {
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

        if (!$this->isReceivedOption('output')) {
            if (!isset($config->application->modelsDir)) {
                throw new CommandsException("Builder doesn't know where is the models directory.");
            }
            $modelsDir = rtrim($config->application->modelsDir, '\\/') . DIRECTORY_SEPARATOR;
        } else {
            $modelsDir = $this->getOption('output');
        }

        if (!$this->path->isAbsolutePath($modelsDir)) {
            $modelsDir = $this->path->getRootPath($modelsDir);
        }

        $modelBuilder = new AllModelsBuilder([
            'force' => $this->isReceivedOption('force'),
            'config' => $config,
            'schema' => $this->getOption('schema'),
            'extends' => $this->getOption('extends'),
            'namespace' => $this->getOption('namespace'),
            'directory' => $this->getOption('directory', null, realpath('.')),
            'foreignKeys' => $this->isReceivedOption('fk'),
            'defineRelations' => $this->isReceivedOption('relations'),
            'genSettersGetters' => $this->isReceivedOption('get-set'),
            'genDocMethods' => $this->isReceivedOption('doc'),
            'modelsDir' => $modelsDir,
            'mapColumn' => $this->isReceivedOption('mapcolumn'),
            'abstract' => $this->isReceivedOption('abstract'),
            'camelize' => $this->isReceivedOption('camelize'),
            'annotate' => $this->isReceivedOption('annotate'),
        ]);

        $modelBuilder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['all-models', 'create-all-models'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
    {
        $this->printParameters($this->getPossibleParams());
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams(): int
    {
        return 0;
    }
}
