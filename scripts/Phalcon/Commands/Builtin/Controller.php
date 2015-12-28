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

use Phalcon\Builder;
use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Builder\Controller as ControllerBuilder;

/**
 * Controller Command
 *
 * Create a handler for the command line.
 *
 * @package     Phalcon\Commands\Builtin
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Controller extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return array(
            'name=s'        => 'Controller name',
            'namespace=s'   => "Controller's namespace [option]",
            'directory=s'   => 'Base path on which project is located [optional]',
            'output=s'      => 'Directory where the controller should be created [optional]',
            'base-class=s'  => 'Base class to be inherited by the controller [optional]',
            'force'         => 'Force to rewrite controller [optional]',
            'module=s'        => 'Module Name .Create File Into Module Dir [optional]',
        );
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @return mixed
     */
    public function run(array $parameters)
    {
        $controllerName = $this->getOption(array('name', 1));

        $controllerBuilder = new ControllerBuilder(array(
            'name' => $controllerName,
            'directory' => $this->getOption('directory'),
            'controllersDir' => $this->getOption('output'),
            'namespace' => $this->getOption('namespace'),
            'baseClass' => $this->getOption('base-class'),
            'force' => $this->isReceivedOption('force'),
            'module'=>$this->getOption('module'),
        ));

        return $controllerBuilder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return array('controller', 'create-controller');
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a controller') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  controller [name] [directory]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

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
