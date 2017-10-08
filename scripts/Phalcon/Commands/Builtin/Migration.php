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
        return [
            'action=s'          => 'Generates a Migration [generate|run]',
            'config=s'          => 'Configuration file',
            'migrations=s'      => 'Migrations directory',
            'directory=s'       => 'Directory where the project was created',
            'table=s'           => 'Table to migrate. Table name or table prefix with asterisk. Default: all',
            'version=s'         => 'Version to migrate',
            'descr=s'           => 'Migration description (used for timestamp based migration)',
            'data=s'            => 'Export data [always|oncreate] (Import data when run migration)',
            'force'             => 'Forces to overwrite existing migrations',
            'ts-based'          => 'Timestamp based migration version',
            'log-in-db'         => 'Keep migrations log in the database table rather than in file',
            'dry'               => 'Attempt requested operation without making changes to system (Generating only)',
            'verbose'           => 'Output of debugging information during operation (Running only)',
            'no-auto-increment' => 'Disable auto increment (Generating only)',
            'help'              => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     *
     * @return mixed
     */
    public function run(array $parameters)
    {
        $path = $this->isReceivedOption('directory') ? $this->getOption('directory') : '';
        $path = realpath($path) . DIRECTORY_SEPARATOR;

        if ($this->isReceivedOption('config')) {
            $config = $this->loadConfig($path . $this->getOption('config'));
        } else {
            $config = $this->getConfig($path);
        }

        if ($this->isReceivedOption('migrations')) {
            $migrationsDir = $path . $this->getOption('migrations');
        } elseif (isset($config['application']['migrationsDir'])) {
            $migrationsDir = $config['application']['migrationsDir'];
            if (!$this->path->isAbsolutePath($migrationsDir)) {
                $migrationsDir = $path . $migrationsDir;
            }
        } elseif (file_exists($path . 'app')) {
            $migrationsDir = $path . 'app/migrations';
        } elseif (file_exists($path . 'apps')) {
            $migrationsDir = $path . 'apps/migrations';
        } else {
            $migrationsDir = $path . 'migrations';
        }

        // keep migrations log in db
        // either "log-in-db" option or "logInDb" config variable from "application" block
        $migrationsInDb = false;
        if ($this->isReceivedOption('log-in-db')) {
            $migrationsInDb = true;
        } elseif (isset($config['application']['logInDb'])) {
            $migrationsInDb = $config['application']['logInDb'];
        }

        // migrations naming is timestamp-based rather than traditional, dotted versions
        // either "ts-based" option or "migrationsTsBased" config variable from "application" block
        $migrationsTsBased = false;
        if ($this->isReceivedOption('ts-based')) {
            $migrationsTsBased = true;
        } elseif (isset($config['application']['migrationsTsBased'])) {
            $migrationsTsBased = $config['application']['migrationsTsBased'];
        }

        $tableName = $this->isReceivedOption('table') ? $this->getOption('table') : '@';
        $action = $this->getOption(['action', 1]);

        switch ($action) {
            case 'generate':
                Migrations::generate([
                    'directory'       => $path,
                    'tableName'       => $tableName,
                    'exportData'      => $this->getOption('data'),
                    'migrationsDir'   => $migrationsDir,
                    'version'         => $this->getOption('version'),
                    'force'           => $this->isReceivedOption('force'),
                    'noAutoIncrement' => $this->isReceivedOption('no-auto-increment'),
                    'config'          => $config,
                    'descr'           => $this->getOption('descr'),
                    'verbose'         => $this->isReceivedOption('dry'),
                ]);
                break;
            case 'run':
                Migrations::run([
                    'directory'      => $path,
                    'tableName'      => $tableName,
                    'migrationsDir'  => $migrationsDir,
                    'force'          => $this->isReceivedOption('force'),
                    'tsBased'        => $migrationsTsBased,
                    'config'         => $config,
                    'version'        => $this->getOption('version'),
                    'migrationsInDb' => $migrationsInDb,
                    'verbose'        => $this->isReceivedOption('verbose'),
                ]);
                break;
            case 'list':
                Migrations::listAll([
                    'directory'      => $path,
                    'tableName'      => $tableName,
                    'migrationsDir'  => $migrationsDir,
                    'force'          => $this->isReceivedOption('force'),
                    'tsBased'        => $migrationsTsBased,
                    'config'         => $config,
                    'version'        => $this->getOption('version'),
                    'migrationsInDb' => $migrationsInDb,
                ]);
                break;
        }
    }

    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getCommands()
    {
        return ['migration', 'create-migration'];
    }

    /**
     * {@inheritdoc}
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

        print Color::head('Usage: List all available migrations') . PHP_EOL;
        print Color::colorize('  migration list', Color::FG_GREEN) . PHP_EOL . PHP_EOL;

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
