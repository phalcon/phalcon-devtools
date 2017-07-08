<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://www.phalconphp.com)      |
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
  |          Paul Scarrone <paul@savvysoftworks.com>                       |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Commands\Builtin;

use Phalcon\Script\Color;
use Phalcon\Commands\Command;
use Phalcon\Utils\SystemInfo;
use Phalcon\Registry;
use Phalcon\DI\FactoryDefault;
use Phalcon\Bootstrap;

/**
 * Serve Command
 *
 * Launch the built-in PHP development server
 *
 * @package Phalcon\Commands\Builtin
 */
class Serve extends Command
{
    const DEFAULT_HOSTNAME  = '0.0.0.0';
    const DEFAULT_PORT      = '8080';
    const DEFAULT_BASE_PATH = 'public/index.php';

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return [
            'hostname=s'        => 'Server Hostname [default='.self::DEFAULT_HOSTNAME.']',
            'port=s'            => 'Server Port [default='.self::DEFAULT_PORT.']',
            'basepath=s'        => 'Project entry-point [default='.self::DEFAULT_BASE_PATH.']',
            'config=s'          => 'Server configuration ini [optional]',
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
        $di = new FactoryDefault();
        $di['registry'] = function () {
            return new Registry();
        };
        passthru($this->shellCommand());
    }

    protected function shellCommand()
    {
        $systemInfo = new SystemInfo();

        $binary_path = $systemInfo->getEnvironment()['PHP Bin'];

        $hostname =  $this->getOption(['hostname', 1], null, self::DEFAULT_HOSTNAME);
        $port =      $this->getOption(['port',     2], null, self::DEFAULT_PORT);
        $base_path = $this->getOption(['basepath', 3], null, self::DEFAULT_BASE_PATH);
        $config = $this->customConfig($this->getOption(['config']));

        return sprintf('%s -S %s:%s %s %s',
            $binary_path,
            $hostname,
            $port,
            'public/index.php',
            $config
        );
    }

    protected function customConfig($config){
        if ($config === null) {
            return '';
        } else {
            return sprintf('-c %s', $config);
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return ['serve', 'server'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
    {
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Launch the built-in PHP development server') . PHP_EOL . PHP_EOL;

        print Color::head('Usage:') . PHP_EOL;
        print Color::colorize('  serve [hostname] [port]', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
        print Color::colorize('  config', Color::FG_GREEN);
        print Color::colorize("\tSpecify a custom php.ini") . PHP_EOL . PHP_EOL;
        print Color::colorize('  help', Color::FG_GREEN);
        print Color::colorize("\t\tShows this help text") . PHP_EOL . PHP_EOL;

        $this->printParameters($this->getPossibleParams());
    }

    /**
     * {@inheritdoc}
     *
     * @return integer
     */
    public function getRequiredParams()
    {
        return 0;
    }
}
