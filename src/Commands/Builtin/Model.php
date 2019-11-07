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

use Phalcon\Config;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\DevTools\Builder\Component\Model as ModelBuilder;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Script\Color;
use Phalcon\DevTools\Utils;
use Phalcon\Text;

/**
 * Model Command
 *
 * Create a model from command line
 */
class Model extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'name=s'          => 'Table name',
            'schema=s'        => 'Name of the schema [optional]',
            'config=s'        => 'Configuration file [optional]',
            'namespace=s'     => "Model's namespace [optional]",
            'get-set'         => 'Attributes will be protected and have setters/getters [optional]',
            'extends=s'       => 'Model extends the class name supplied [optional]',
            'excludefields=l' => 'Excludes fields defined in a comma separated list [optional]',
            'doc'             => 'Helps to improve code completion on IDEs [optional]',
            'directory=s'     => 'Base path on which project is located [optional]',
            'output=s'        => 'Folder where models are located [optional]',
            'force'           => 'Rewrite the model [optional]',
            'camelize'        => 'Properties is in camelCase [optional]',
            'trace'           => 'Shows the trace of the framework in case of exception [optional]',
            'mapcolumn'       => 'Get some code for map columns [optional]',
            'abstract'        => 'Abstract Model [optional]',
            'annotate'        => 'Annotate Attributes [optional]',
            'help'            => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @throws BuilderException
     */
    public function run(array $parameters): void
    {
        $name = $this->getOption(['name', 1]);
        $className = Utils::camelize(isset($parameters[1]) ? $parameters[1] : $name, '_-');

        $modelBuilder = new ModelBuilder(
            [
                'name'              => $name,
                'schema'            => $this->getOption('schema'),
                'config'            => $this->getConfigObject(),
                'className'         => $className,
                'fileName'          => Text::uncamelize($className),
                'genSettersGetters' => $this->isReceivedOption('get-set'),
                'genDocMethods'     => $this->isReceivedOption('doc'),
                'namespace'         => $this->getOption('namespace'),
                'directory'         => $this->getOption('directory'),
                'modelsDir'         => $this->getOption('output'),
                'extends'           => $this->getOption('extends'),
                'excludeFields'     => $this->getOption('excludefields'),
                'camelize'          => $this->isReceivedOption('camelize'),
                'force'             => $this->isReceivedOption('force'),
                'mapColumn'         => $this->isReceivedOption('mapcolumn'),
                'abstract'          => $this->isReceivedOption('abstract'),
                'annotate'          => $this->isReceivedOption('annotate')
            ]
        );

        $modelBuilder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['model', 'create-model'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a model') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  model [table-name] [options]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
        print Color::colorize('  help', Color::FG_GREEN);
        print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

        $this->printParameters($this->getPossibleParams());
    }

    /**
     * {@inheritdoc}
     *
     * @return int
     */
    public function getRequiredParams(): int
    {
        return 1;
    }

    /**
     * Get Config object
     *
     * @return Config
     * @throws BuilderException
     */
    protected function getConfigObject(): Config
    {
        if (!$this->isReceivedOption('config')) {
            return $this->path->getConfig();
        }

        $configPath = $this->getOption('config');
        if (false == $this->path->isAbsolutePath($this->getOption('config'))) {
            $configPath = $this->path->getRootPath() . $this->getOption('config');
        }

        if (preg_match('/.*(:?\.ini)(?:\s)?$/i', $configPath)) {
            return new ConfigIni($configPath);
        }

        $config = include $configPath;
        if (is_array($config)) {
            return new Config($config);
        }

        return $config;
    }
}
