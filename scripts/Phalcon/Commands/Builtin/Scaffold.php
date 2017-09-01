<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
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

use Phalcon\Builder;
use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Builder\Scaffold as ScaffoldBuilder;

/**
 * Scaffold Command
 *
 * Scaffold a controller, model and view for a database table
 *
 * @package Phalcon\Commands\Builtin
 */
class Scaffold extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'table-name=s'      => 'Table used as base to generate the scaffold',
            'schema=s'          => 'Name of the schema [optional]',
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
     */
    public function run(array $parameters)
    {
        $name = $this->getOption(['table-name', 1]);
        $templatePath = $this->getOption(['template-path'], null, TEMPLATE_PATH);
        $schema = $this->getOption('schema');
        $templateEngine = $this->getOption(['template-engine'], null, "phtml");

        $scaffoldBuilder = new ScaffoldBuilder([
            'name'                 => $name,
            'schema'               => $schema,
            'force'                => $this->isReceivedOption('force'),
            'genSettersGetters'    => $this->isReceivedOption('get-set'),
            'directory'            => $this->getOption('directory'),
            'templatePath'         => $templatePath,
            'templateEngine'       => $templateEngine,
            'modelsNamespace'      => $this->getOption('ns-models'),
            'controllersNamespace' => $this->getOption('ns-controllers'),
        ]);

        return $scaffoldBuilder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return ['scaffold', 'create-scaffold'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
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

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 1;
    }
}
