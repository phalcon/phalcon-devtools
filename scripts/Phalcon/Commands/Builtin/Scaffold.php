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

use Phalcon\Builder;
use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Commands\CommandsInterface;
use Phalcon\Builder\Scaffold as ScaffoldBuilder;

/**
 * \Phalcon\Command\Scaffold
 *
 * Scaffold a controller, model and view for a database table
 *
 * @category 	Phalcon
 * @package 	Command
 * @subpackage  Scaffold
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Scaffold extends Command implements CommandsInterface
{

    protected $_possibleParameters = array(
        'table-name=s'   => "Table used as base to generate the scaffold",
        'schema=s'       => "Name of the schema. [optional]",
        'get-set'        => "Attributes will be protected and have setters/getters. [optional]",
        'directory=s'    => "Base path on which project was created [optional]",
        'template-path=s'	 => 'Specify a template path [optional]',
        'template-engine=s'=> 'Define the template engine, default php (php, volt). [optional]',
        'force'          => "Forces to rewrite generated code if they already exists. [optional]",
        'trace'          => "Shows the trace of the framework in case of exception. [optional]",
    );

    /**
     * @param $parameters
     *
     * @return bool
     */
    public function run($parameters)
    {

        $name = $this->getOption(array('table-name', 1));
        $templatePath = $this->getOption(array('template-path'), null, TEMPLATE_PATH);
        $schema = $this->getOption('schema');
        $templateEngine = $this->getOption(array('template-engine'), null, "php");

        $scaffoldBuilder = new scaffoldBuilder(array(
            'name' => $name,
            'schema' => $schema,
            'force'	=> $this->isReceivedOption('force'),
            'genSettersGetters' => $this->isReceivedOption('get-set'),
            'directory' => $this->getOption('directory'),
            'templatePath' => $templatePath,
            'templateEngine'=> $templateEngine,
        ));

        return $scaffoldBuilder->build();
    }

    /**
     * Returns the command identifier
     *
     * @return string
     */
    public function getCommands()
    {
        return array('scaffold');
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
     * Prints help on the usage of the command
     *
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a scaffold from a database table') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  scaffold [tableName] [options]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
        print Color::colorize('  ?', Color::FG_GREEN);
        print Color::colorize("\tShows this help text") . PHP_EOL . PHP_EOL;

        $this->printParameters($this->_possibleParameters);
    }

    /**
     * Returns number of required parameters for this command
     *
     * @return int
     */
    public function getRequiredParams()
    {
        return 1;
    }

}
