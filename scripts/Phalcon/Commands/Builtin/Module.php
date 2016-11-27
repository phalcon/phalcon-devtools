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

use Phalcon\Commands\Command;
use Phalcon\Script\Color;
use Phalcon\Builder\Module as ModuleBuilder;

/**
 * Module Command
 *
 * Create a module from command line
 *
 * @package Phalcon\Commands\Builtin
 */
class Module extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'name'            => 'Name of the new module',
            'namespace=s'     => "Module's namespace [optional]",
            'output=s'        => 'Folder where modules are located [optional]',
            'config-type=s'   => 'The config type to be generated (ini, json, php, yaml) [optional]',
            'template-path=s' => 'Specify a template path [optional]',
            'help'            => 'Shows this help [optional]',

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
        $moduleName   = $this->getOption(['name', 1]);
        $namespace    = $this->getOption('namespace', null, 'Application');
        $configType   = $this->getOption('config-type', null, 'php');
        $modulesDir   = $this->getOption('output');
        $templatePath = $this->getOption('template-path', null, TEMPLATE_PATH . DIRECTORY_SEPARATOR . 'module');

        $builder = new ModuleBuilder([
            'name'         => $moduleName,
            'namespace'    => $namespace,
            'config-type'  => $configType,
            'templatePath' => $templatePath,
            'modulesDir'   => $modulesDir
        ]);

        return $builder->build();
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return ['module', 'create-module'];
    }

    /**
     * {@inheritdoc}
     *
     * @return boolean
     */
    public function canBeExternal()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Creates a module') . PHP_EOL . PHP_EOL;

        print Color::head('Example') . PHP_EOL;
        print Color::colorize('  phalcon module backend', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

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
