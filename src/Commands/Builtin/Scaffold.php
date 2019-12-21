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
use Phalcon\DevTools\Builder\Component\Scaffold as ScaffoldBuilder;
use Phalcon\DevTools\Builder\Exception\BuilderException;
use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Commands\CommandsException;
use Phalcon\DevTools\Script\Color;

/**
 * Scaffold Command
 *
 * Scaffold a controller, model and view for a database table
 */
class Scaffold extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'table-name=s'      => 'Table used as base to generate the scaffold',
            'schema=s'          => 'Name of the schema [optional]',
            'config=s'          => 'Configuration file [optional]',
            'get-set'           => 'Attributes will be protected and have setters/getters. [optional]',
            'directory=s'       => 'Base path on which project was created [optional]',
            'template-path=s'   => 'Specify a template path [optional]',
            'template-engine=s' => 'Define the template engine, default phtml (phtml, volt) [optional]',
            'force'             => 'Forces to rewrite generated code if they already exists [optional]',
            'trace'             => 'Shows the trace of the framework in case of exception [optional]',
            'ns-models=s'       => "Model's namespace [optional]",
            'ns-controllers=s'  => "Controller's namespace [optional]",
            'help'              => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @return mixed
     * @throws CommandsException
     * @throws BuilderException
     */
    public function run(array $parameters)
    {
        $name = $this->getOption(['table-name', 1]);
        $templatePath = $this->getOption(['template-path'], null, TEMPLATE_PATH);
        $schema = $this->getOption('schema');
        $templateEngine = $this->getOption(['template-engine'], null, "phtml");
        $path = $this->getDirectoryPath();

        $scaffoldBuilder = new ScaffoldBuilder([
            'name'                 => $name,
            'schema'               => $schema,
            'force'                => $this->isReceivedOption('force'),
            'genSettersGetters'    => $this->isReceivedOption('get-set'),
            'directory'            => $path,
            'templatePath'         => $templatePath,
            'templateEngine'       => $templateEngine,
            'modelsNamespace'      => $this->getOption('ns-models'),
            'controllersNamespace' => $this->getOption('ns-controllers'),
            'config'               => $this->getreceivedOrDefaultConfig($path),
        ]);

        return $scaffoldBuilder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands(): array
    {
        return ['scaffold', 'create-scaffold'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a scaffold from a database table') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  scaffold [tableName] [options]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
        print Color::colorize('  help', Color::FG_GREEN);
        print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

        $this->printParameters($this->getPossibleParams());
    }

    protected function getDirectoryPath()
    {
        $path = $this->isReceivedOption('directory') ? $this->getOption('directory') : '';

        return realpath($path) . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $path
     * @return Config
     * @throws CommandsException
     */
    protected function getreceivedOrDefaultConfig(string $path): Config
    {
        if ($this->isReceivedOption('config')) {
            return $this->loadConfig($path . $this->getOption('config'));
        }

        return $this->getConfig($path);
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams(): int
    {
        return 1;
    }
}
