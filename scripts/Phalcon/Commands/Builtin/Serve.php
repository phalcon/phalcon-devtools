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
    const DEFAULT_HOSTNAME      = '0.0.0.0';
    const DEFAULT_PORT          = '8000';
    const DEFAULT_BASE_PATH     = '.htrouter.php';
    const DEFAULT_DOCUMENT_ROOT = 'public';

    protected $_hostname =      '';
    protected $_port =          '';
    protected $_base_path =     '';
    protected $_document_root = '';
    protected $_config =        '';

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
            'rootpath=s'        => 'Document Root (public assets) [default='.self::DEFAULT_DOCUMENT_ROOT.']',
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
        $cmd = $this->shellCommand();
        print Color::head("Starting Server with $cmd") . PHP_EOL . PHP_EOL;
        passthru($cmd);
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function prepareOptions()
    {
        $this->_hostname      = $this->getOption(['hostname', 1], null, self::DEFAULT_HOSTNAME);
        $this->_port          = $this->getOption(['port',     2], null, self::DEFAULT_PORT);
        $this->_base_path     = $this->getOption(['basepath', 3], null, self::DEFAULT_BASE_PATH);
        $this->_document_root = $this->getOption(['rootpath', 4], null, self::DEFAULT_DOCUMENT_ROOT);
        $this->_config        = $this->customConfig($this->getOption(['config']));
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function printServerDetails()
    {
        print Color::head('Preparing Development Server') . PHP_EOL;
        print Color::colorize("  Host: $this->_hostname", Color::FG_GREEN) . PHP_EOL;
        print Color::colorize("  Port: $this->_port", Color::FG_GREEN) . PHP_EOL;
        print Color::colorize("  Base: $this->_base_path", Color::FG_GREEN) . PHP_EOL;
        print Color::colorize("  Document Root: $this->_document_root", Color::FG_GREEN) . PHP_EOL;
        if($this->_config != null) {
            print Color::colorize("   ini: $$this->_config", Color::FG_GREEN) . PHP_EOL;
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function shellCommand()
    {
        $systemInfo = new SystemInfo();
        $binary_path = $systemInfo->getEnvironment()['PHP Bin'];

        $this->prepareOptions();
        $this->printServerDetails();

        return sprintf('%s -S %s:%s -t %s %s %s',
            $binary_path,
            $this->_hostname,
            $this->_port,
            $this->_document_root,
            $this->_base_path,
            $this->_config
        );
    }

    /**
     * {@inheritdoc}
     *
     * @param  string
     * @return string
     */
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
        print Color::colorize('  serve [hostname='.self::DEFAULT_HOSTNAME.
            '] [port='.self::DEFAULT_PORT.
            '] [entrypoint='.self::DEFAULT_BASE_PATH.
            '] [document-root='.self::DEFAULT_DOCUMENT_ROOT.']', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Arguments:') . PHP_EOL;
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

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getHostname()
    {
        return $this->_hostname;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->_base_path;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getDocumentRoot()
    {
        return $this->_document_root;
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getConfigPath()
    {
        return $this->_config;
    }
}
