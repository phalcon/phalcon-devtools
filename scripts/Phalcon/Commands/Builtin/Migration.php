<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
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
use Phalcon\Migrations;
use Phalcon\Config;

/**
 * Migration Command
 *
 * Generates/Run a migration
 *
 * @package Phalcon\Commands\Builtin
 */
class Migration extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams()
    {
        return array(
            'action=s'          => 'Generates a Migration [generate|run]',
            'config=s'          => 'Configuration file',
            'migrations=s'      => 'Migrations directory',
            'directory=s'       => 'Directory where the project was created',
            'table=s'           => 'Table to migrate. Default: all',
            'version=s'         => 'Version to migrate',
            'descr=s'           => 'Migration version description (new-style migration naming)',
            'force'             => 'Forces to overwrite existing migrations',
            'no-auto-increment' => 'Disable auto increment (Generating only)',
            'data=s'            => 'Export data [always|oncreate] (Import data when run migration)',
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
        // Build path to the core app files
        $path = $this->isReceivedOption('directory') ? $this->getOption('directory') : '';
        $path = realpath($path).DIRECTORY_SEPARATOR;

        // Load configuration
        if ($this->isReceivedOption('config')) {
            $config = $this->loadConfig($path.$this->getOption('config'));
        } else {
            $config = $this->getConfig($path);
        }

        // Look for migrations
        if ($this->isReceivedOption('migrations')) {
            $migrationsDir = $path.$this->getOption('migrations');
        } elseif (isset($config['application']['migrationsDir'])) {
            $migrationsDir = $config['application']['migrationsDir'];
            if (!$this->path->isAbsolutePath($migrationsDir)) {
                $migrationsDir = $path.$migrationsDir;
            }
        } elseif (file_exists($path.'app')) {
            $migrationsDir = $path.'app/migrations';
        } elseif (file_exists($path.'apps')) {
            $migrationsDir = $path.'apps/migrations';
        } else {
            $migrationsDir = $path.'migrations';
        }

        // Load other optins
        $tableName = $this->isReceivedOption('table') ? $tableName = $this->getOption('table') : 'all';
        $exportData = $this->getOption('data');
        $descr = $this->getOption('descr');
        $action = $this->getOption(array('action', 1));
        $version = $this->getOption('version');

        if ($action == 'generate') {
            Migrations::generate(
                array(
                    'directory'     => $path,
                    'tableName'     => $tableName,
                    'exportData'    => $exportData,
                    'migrationsDir' => $migrationsDir,
                    'version'       => $version,
                    'force'         => $this->isReceivedOption('force'),
                    'no-ai'         => $this->isReceivedOption('no-auto-increment'),
                    'config'        => $config,
                    'descr'         => $descr,
                )
            );
        } else {
            if ($action == 'run') {
                Migrations::run(
                    array(
                        'directory'     => $path,
                        'tableName'     => $tableName,
                        'migrationsDir' => $migrationsDir,
                        'force'         => $this->isReceivedOption('force'),
                        'config'        => $config,
                        'version'       => $version,
                        'descr'         => $descr,
                    )
                );
            }
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return array('migration', 'create-migration');
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp()
    {
        print Color::head('Help:').PHP_EOL;
        print Color::colorize('  Generates/Run a Migration').PHP_EOL.PHP_EOL;

        print Color::head('Usage: Generate a Migration').PHP_EOL;
        print Color::colorize('  migration generate', Color::FG_GREEN).PHP_EOL.PHP_EOL;

        print Color::head('Usage: Run a Migration').PHP_EOL;
        print Color::colorize('  migration run', Color::FG_GREEN).PHP_EOL.PHP_EOL;

        print Color::head('Arguments:').PHP_EOL;
        print Color::colorize('  help', Color::FG_GREEN);
        print Color::colorize("\tShows this help text").PHP_EOL.PHP_EOL;

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
