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
use Phalcon\DevTools\Commands\Command;
use Phalcon\DevTools\Commands\CommandsException;
use Phalcon\DevTools\Script\Color;
use Phalcon\Migrations\Migrations;
use Phalcon\Migrations\Script\ScriptException;
use Phalcon\Mvc\Model\Exception;

/**
 * Migration Command
 *
 * Generates/Run a migration
 */
class Migration extends Command
{
    /**
     * {@inheritdoc}
     *
     * @return array
     */
    public function getPossibleParams(): array
    {
        return [
            'action=s' => 'Generates a Migration [generate|run]',
            'config=s' => 'Configuration file',
            'migrations=s' => 'Migrations directory. Use comma separated string to specify multiple directories',
            'directory=s' => 'Directory where the project was created',
            'table=s' => 'Table to migrate. Table name or table prefix with asterisk. Default: all',
            'version=s' => 'Version to migrate',
            'descr=s' => 'Migration description (used for timestamp based migration)',
            'data=s' => 'Export data [always|oncreate] (Import data when run migration)',
            'exportDataFromTables=s' => 'Export data from specific tables, use comma separated string.',
            'force' => 'Forces to overwrite existing migrations',
            'ts-based' => 'Timestamp based migration version',
            'log-in-db' => 'Keep migrations log in the database table rather than in file',
            'dry' => 'Attempt requested operation without making changes to system (Generating only)',
            'verbose' => 'Output of debugging information during operation (Running only)',
            'no-auto-increment' => 'Disable auto increment (Generating only)',
            'help' => 'Shows this help [optional]',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @param array $parameters
     * @throws CommandsException
     * @throws ScriptException
     * @throws Exception
     */
    public function run(array $parameters): void
    {
        $path = $this->isReceivedOption('directory') ? $this->getOption('directory') : '';
        $path = realpath($path) . DIRECTORY_SEPARATOR;

        if ($this->isReceivedOption('config')) {
            $config = $this->loadConfig($path . $this->getOption('config'));
        } else {
            $config = $this->getConfig($path);
        }

        $exportDataFromTables= [];
        if ($this->isReceivedOption('exportDataFromTables')) {
            $exportDataFromTables = explode(',', $this->getOption('exportDataFromTables'));
        } elseif (isset($config['application']['exportDataFromTables'])) {
            if ($config['application']['exportDataFromTables'] instanceof Config) {
                $exportDataFromTables = $config['application']['exportDataFromTables']->toArray();
            } else {
                $exportDataFromTables = explode(',', $config['application']['exportDataFromTables']);
            }
        }

        //multiple dir
        $migrationsDir = [];
        if ($this->isReceivedOption('migrations')) {
            $migrationsDir = explode(',', $this->getOption('migrations'));
        } elseif (isset($config['application']['migrationsDir'])) {
            $migrationsDir = explode(',', $config['application']['migrationsDir']);
        }


        if (!empty($migrationsDir)) {
            foreach ($migrationsDir as $id => $dir) {
                if (!$this->path->isAbsolutePath($dir)) {
                    $migrationsDir[$id] = $path . $dir;
                }
            }
        } elseif (file_exists($path . 'app')) {
            $migrationsDir[] = $path . 'app/migrations';
        } elseif (file_exists($path . 'apps')) {
            $migrationsDir[] = $path . 'apps/migrations';
        } else {
            $migrationsDir[] = $path . 'migrations';
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
                    'exportDataFromTables'      => $exportDataFromTables,
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
    public function getCommands(): array
    {
        return ['migration', 'create-migration'];
    }

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function getHelp(): void
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
     * @return int
     */
    public function getRequiredParams(): int
    {
        return 1;
    }
}
