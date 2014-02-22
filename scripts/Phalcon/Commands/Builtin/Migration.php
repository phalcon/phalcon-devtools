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
use Phalcon\Migrations;

/**
 * Migration
 *
 * Generates/Run a migration
 *
 * @category 	Phalcon
 * @package 	Command
 * @subpackage  Controller
 * @copyright   Copyright (c) 2011-2014 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 */
class Migration extends Command implements CommandsInterface
{

    protected $_possibleParameters = array(
        'action=s' 		=> "Generates a Migration [generate|run]",
        'config=s' 		=> "Configuration file.",
        'migrations=s'	=> "Migrations directory.",
        'directory=s' 	=> "Directory where the project was created.",
        'table=s' 		=> "Table to migrate. Default: all.",
        'version=s' 	=> "Version to migrate.",
        'force' 		=> "Forces to overwrite existing migrations.",
    );

    /**
     * Determines correct adapter by file name
     * and load config
     *
     * @param $fileName
     *
     * @return bool|mixed|\Phalcon\Config\Adapter\Ini|\Phalcon\Config\Adapter\Json
     */
    protected static function _loadConfig($fileName)
    {
        $pathInfo = pathinfo($fileName);

        if (isset($pathInfo['extension'])) {
            $extension = $pathInfo['extension'];
            if ($extension === 'php') {
                return include($fileName);
            } elseif ($extension === 'ini') {
                return new \Phalcon\Config\Adapter\Ini($fileName);
            } elseif ($extension === 'json') {
                return new \Phalcon\Config\Adapter\Json($fileName);
            }
        }

        return false;
    }

    /**
     * @param $path
     *
     * @return mixed|\Phalcon\Config\Adapter\Ini|\Phalcon\Config\Adapter\Json
     * @throws \Phalcon\Builder\BuilderException
     */
    protected static function _getConfig($path)
    {
        foreach (array('app/config/', 'config/') as $configPath) {
            if (file_exists($path . $configPath. "config.ini")) {
                return new \Phalcon\Config\Adapter\Ini($path . $configPath. "/config.ini");
            } elseif (file_exists($path . $configPath. "/config.php")) {
                $config = include($path . $configPath. "/config.php");

                return $config;
            } elseif (file_exists($path . $configPath. "/config.json")) {
                return new \Phalcon\Config\Adapter\Json($path . $configPath. "/config.json");
            }
        }

        $directory = new \RecursiveDirectoryIterator('.');
        $iterator = new \RecursiveIteratorIterator($directory);
        foreach ($iterator as $f) {
            if (preg_match('/config\.php$/', $f->getPathName())) {
                $config = include($f->getPathName());

                return $config;
            } elseif (preg_match('/config\.ini$/', $f->getPathName())) {
                return new \Phalcon\Config\Adapter\Ini($f->getPathName());
            } elseif (preg_match('/config\.json$/', $f->getPathName())) {
                return new \Phalcon\Config\Adapter\Json($f->getPathName());
            }
        }
        throw new BuilderException('Builder can\'t locate the configuration file');
    }

    /**
     * Run the command
     */
    public function run($parameters)
    {

        if ($this->isReceivedOption('table')) {
            $tableName = $this->getOption('table');
        } else {
            $tableName = 'all';
        }

        $path = '';
        if ($this->isReceivedOption('directory')) {
            $path = $this->getOption('directory') .'/';
        }

        if ($this->isReceivedOption('migrations')) {
            $migrationsDir = $path.$this->getOption('migrations');
        } else {
            $migrationsDir = $path.'app/migrations';
        }

        $exportData = $this->getOption('data');
        $originalVersion = $this->getOption('version');

        if ($this->isReceivedOption('config')) {
            $configPath = $path . $this->getOption('config');
            $config = $this->_loadConfig($configPath);
        } else {
            $config = $this->_getConfig($path);
        }

        $action = $this->getOption(array('action', 1));

        if ($action == 'generate') {
            Migrations::generate(array(
                'directory' => $path,
                'tableName' => $tableName,
                'exportData' => $exportData,
                'migrationsDir' => $migrationsDir,
                'originalVersion' => $originalVersion,
                'force' => $this->isReceivedOption('force'),
                'config' => $config
            ));
        } else {
            if ($action == 'run') {
                Migrations::run(array(
                    'directory' => $path,
                    'tableName' => $tableName,
                    'migrationsDir' => $migrationsDir,
                    'force' => $this->isReceivedOption('force'),
                    'config' => $config
                ));
            }
        }

    }

    /**
     * Returns the command identifier
     *
     * @return string
     */
    public function getCommands()
    {
        return array('migration');
    }

    /**
     * Checks whether the command can be executed outside a Phalcon project
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
        print Color::head('Help:') . PHP_EOL;
        print Color::colorize('  Generates/Run a Migration') . PHP_EOL . PHP_EOL;

        print Color::head('Usage: Generate a Migration') . PHP_EOL;
        print Color::colorize('  migration generate', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

        print Color::head('Usage: Run a Migration') . PHP_EOL;
        print Color::colorize('  migration run', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

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
