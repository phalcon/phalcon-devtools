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
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon;

use Phalcon\Db\Index;
use DirectoryIterator;
use Phalcon\Db\Column;
use Phalcon\Db\Adapter;
use Phalcon\Script\Color;
use Phalcon\Db\AdapterInterface;
use Phalcon\Version\ItemInterface;
use Phalcon\Script\ScriptException;
use Phalcon\Db\Exception as DbException;
use Phalcon\Mvc\Model\Exception as ModelException;
use Phalcon\Mvc\Model\Migration as ModelMigration;
use Phalcon\Version\IncrementalItem as IncrementalVersion;
use Phalcon\Version\ItemCollection as VersionCollection;

/**
 * Migrations Class
 *
 * @package Phalcon
 */
class Migrations
{
    /**
     * name of the migration table
     */
    const MIGRATION_LOG_TABLE = 'phalcon_migrations';

    /**
     * Filename or db connection to store migrations log
     * @var mixed|Adapter\Pdo
     */
    protected static $_storage;

    /**
     * Check if the script is running on Console mode
     *
     * @return boolean
     */
    public static function isConsole()
    {
        return PHP_SAPI === 'cli';
    }

    /**
     * Generate migrations
     *
     * @param array $options
     *
     * @throws \Exception
     * @throws \LogicException
     * @throws \RuntimeException
     */
    public static function generate(array $options)
    {
        $tableName = $options['tableName'];
        $exportData = $options['exportData'];
        $migrationsDir = $options['migrationsDir'];
        $version = isset($options['version']) ? $options['version'] : null;
        $force = $options['force'];
        $config = $options['config'];
        $descr = isset($options['descr']) ? $options['descr'] : null;
        $noAutoIncrement = isset($options['noAutoIncrement']) ? $options['noAutoIncrement'] : null;

        // Migrations directory
        if ($migrationsDir && !file_exists($migrationsDir)) {
            mkdir($migrationsDir, 0755, true);
        }

        // Use timestamped version if description is provided
        if ($descr) {
            $version = (string)(int)(microtime(true) * pow(10, 6));
            VersionCollection::setType(VersionCollection::TYPE_TIMESTAMPED);
            $versionItem = VersionCollection::createItem($version . '_' . $descr);

            // Elsewhere use old-style incremental versioning
            // The version is specified
        } elseif ($version) {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
            $versionItem = VersionCollection::createItem($version);

            // The version is guessed automatically
        } else {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
            $versionItems = ModelMigration::scanForVersions($migrationsDir);

            if (!isset($versionItems[0])) {
                $versionItem = VersionCollection::createItem('1.0.0');

            } else {
                /** @var IncrementalVersion $versionItem */
                $versionItem = VersionCollection::maximum($versionItems);
                $versionItem = $versionItem->addMinor(1);
            }
        }

        // Path to migration dir
        $migrationPath = rtrim($migrationsDir, '\\/') . DIRECTORY_SEPARATOR . $versionItem->getVersion();
        if (!file_exists($migrationPath)) {
            if (is_writable(dirname($migrationPath))) {
                mkdir($migrationPath);
            } else {
                throw new \RuntimeException("Unable to write '{$migrationPath}' directory. Permission denied");
            }
        } elseif (!$force) {
            throw new \LogicException('Version ' . $versionItem->getVersion() . ' already exists');
        }

        // Try to connect to the DB
        if (!isset($config->database)) {
            throw new \RuntimeException('Cannot load database configuration');
        }
        ModelMigration::setup($config->database);
        ModelMigration::setSkipAutoIncrement($noAutoIncrement);
        ModelMigration::setMigrationPath($migrationsDir);

        $wasMigrated = false;
        if ($tableName === '@') {
            $migrations = ModelMigration::generateAll($versionItem, $exportData);
            foreach ($migrations as $tableName => $migration) {
                if ($tableName === self::MIGRATION_LOG_TABLE) {
                    continue;
                }
                $tableFile = $migrationPath . DIRECTORY_SEPARATOR . $tableName . '.php';
                $wasMigrated = file_put_contents(
                        $tableFile,
                        '<?php ' . PHP_EOL . PHP_EOL . $migration
                    ) || $wasMigrated;
            }
        } else {
            $tables = explode(',', $tableName);
            foreach ($tables as $table) {
                $migration = ModelMigration::generate($versionItem, $table, $exportData);
                $tableFile = $migrationPath . DIRECTORY_SEPARATOR . $table . '.php';
                $wasMigrated = file_put_contents(
                    $tableFile,
                    '<?php ' . PHP_EOL . PHP_EOL . $migration
                );
            }
        }

        if (self::isConsole() && $wasMigrated) {
            print Color::success('Version ' . $versionItem->getVersion() . ' was successfully generated') . PHP_EOL;
        } elseif (self::isConsole()) {
            print Color::info('Nothing to generate. You should create tables first.') . PHP_EOL;
        }
    }

    /**
     * Run migrations
     *
     * @param array $options
     *
     * @throws Exception
     * @throws ModelException
     * @throws ScriptException
     *
     */
    public static function run(array $options)
    {
        // Define versioning type to be used
        if (isset($options['tsBased']) && true === $options['tsBased']) {
            VersionCollection::setType(VersionCollection::TYPE_TIMESTAMPED);
        } else {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
        }

        $migrationsDir = rtrim($options['migrationsDir'], '\\/');
        if (!file_exists($migrationsDir)) {
            throw new ModelException('Migrations directory was not found.');
        }

        /** @var Config $config */
        $config = $options['config'];
        if (!$config instanceof Config) {
            throw new ModelException('Internal error. Config should be an instance of ' . Config::class);
        }

        // Init ModelMigration
        if (!isset($config->database)) {
            throw new ScriptException('Cannot load database configuration');
        }

        $finalVersion = null;
        if (isset($options['version']) && $options['version'] !== null) {
            $finalVersion = VersionCollection::createItem($options['version']);
        }

        $tableName = '@';
        if (isset($options['tableName'])) {
            $tableName = $options['tableName'];
        }

        $versionItems = ModelMigration::scanForVersions($migrationsDir);

        if (!isset($versionItems[0])) {
            throw new ModelException('Migrations were not found at ' . $migrationsDir);
        }

        // Set default final version
        if ($finalVersion === null) {
            $finalVersion = VersionCollection::maximum($versionItems);
        }

        ModelMigration::setup($config->database);
        ModelMigration::setMigrationPath($migrationsDir);
        self::connectionSetup($options);
        $initialVersion = self::getCurrentVersion($options);
        $completedVersions = self::getCompletedVersions($options);

        // Everything is up to date
        if ($initialVersion->getStamp() === $finalVersion->getStamp()) {
            print Color::info('Everything is up to date');
            exit(0);
        }

        $direction = ModelMigration::DIRECTION_FORWARD;
        if ($finalVersion->getStamp() < $initialVersion->getStamp()) {
            $direction = ModelMigration::DIRECTION_BACK;
        }

        if (ModelMigration::DIRECTION_FORWARD === $direction) {
            // If we migrate up, we should go from the beginning to run some migrations which may have been missed
            $versionItemsTmp = VersionCollection::sortAsc(array_merge($versionItems, [$initialVersion]));
            $initialVersion = $versionItemsTmp[0];
        } else {
            // If we migrate downs, we should go from the last migration to revert some migrations which may have been missed
            $versionItemsTmp = VersionCollection::sortDesc(array_merge($versionItems, [$initialVersion]));
            $initialVersion = $versionItemsTmp[0];
        }

        // Run migration
        $versionsBetween = VersionCollection::between($initialVersion, $finalVersion, $versionItems);
        foreach ($versionsBetween as $versionItem) {

            // If we are rolling back, we skip migrating when initialVersion is the same as current
            if ($initialVersion->getVersion() === $versionItem->getVersion() && ModelMigration::DIRECTION_BACK === $direction) {
                continue;
            }

            if ((ModelMigration::DIRECTION_FORWARD === $direction) && isset($completedVersions[(string)$versionItem])) {
                print Color::info('Version ' . (string)$versionItem . ' was already applied');
                continue;
            } elseif ((ModelMigration::DIRECTION_BACK === $direction) && !isset($completedVersions[(string)$initialVersion])) {
                print Color::info('Version ' . (string)$initialVersion . ' was already rolled back');
                $initialVersion = $versionItem;
                continue;
            }

            if ($initialVersion->getVersion() === $finalVersion->getVersion() && ModelMigration::DIRECTION_BACK === $direction) {
                break;
            }

            $migrationStartTime = date("Y-m-d H:i:s");
            if ($tableName === '@') {
                // Directory depends on Forward or Back Migration
                $iterator = new DirectoryIterator(
                    $migrationsDir . DIRECTORY_SEPARATOR . (ModelMigration::DIRECTION_BACK === $direction ? $initialVersion->getVersion() : $versionItem->getVersion())
                );
                foreach ($iterator as $fileInfo) {
                    if (!$fileInfo->isFile() || 0 !== strcasecmp($fileInfo->getExtension(), 'php')) {
                        continue;
                    }
                    ModelMigration::migrate($initialVersion, $versionItem, $fileInfo->getBasename('.php'), $direction);
                }
            } else {
                ModelMigration::migrate($initialVersion, $versionItem, $tableName, $direction);
            }

            if (ModelMigration::DIRECTION_FORWARD == $direction) {
                self::addCurrentVersion($options, (string)$versionItem, $migrationStartTime);
                print Color::success('Version ' . $versionItem . ' was successfully migrated');
            } else {
                self::removeCurrentVersion($options, (string)$initialVersion);
                print Color::success('Version ' . $initialVersion . ' was successfully rolled back');
            }

            $initialVersion = $versionItem;
        }
    }

    /**
     * List migrations along with statuses
     *
     * @param array $options
     *
     * @throws Exception
     * @throws ModelException
     * @throws ScriptException
     *
     */
    public static function listAll(array $options)
    {
        // Define versioning type to be used
        if (true === $options['tsBased']) {
            VersionCollection::setType(VersionCollection::TYPE_TIMESTAMPED);
        } else {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
        }

        $migrationsDir = rtrim($options['migrationsDir'], '/');
        if (!file_exists($migrationsDir)) {
            throw new ModelException('Migrations directory was not found.');
        }

        /** @var Config $config */
        $config = $options['config'];
        if (!$config instanceof Config) {
            throw new ModelException('Internal error. Config should be an instance of ' . Config::class);
        }

        // Init ModelMigration
        if (!isset($config->database)) {
            throw new ScriptException('Cannot load database configuration');
        }

        $versionItems = ModelMigration::scanForVersions($migrationsDir);

        if (!isset($versionItems[0])) {
            print Color::info('Migrations were not found at ' . $migrationsDir);
            return;
        }

        ModelMigration::setup($config->database);
        ModelMigration::setMigrationPath($migrationsDir);
        self::connectionSetup($options);

        $completedVersions = self::getCompletedVersions($options);
        $versionItems = VersionCollection::sortDesc($versionItems);

        $versionColumnWidth = 27;
        foreach ($versionItems as $versionItem) {
            if (strlen($versionItem) > ($versionColumnWidth - 2)) {
                $versionColumnWidth = strlen($versionItem) + 2;
            }
        }
        $format = "│ %-" . ($versionColumnWidth - 2) . "s │ %12s │";

        $report = [];
        foreach ($versionItems as $versionItem) {
            $versionNumber = $versionItem->getVersion();
            $report[] = sprintf($format, $versionNumber, isset($completedVersions[$versionNumber]) ? 'Y' : 'N');
        }

        $header = sprintf($format, 'Version', 'Was applied');
        $report[] = '├' . str_repeat('─', $versionColumnWidth) . '┼'. str_repeat('─', 14) . '┤';
        $report[] = $header;

        $report = array_reverse($report);

        echo '┌' . str_repeat('─', $versionColumnWidth) . '┬'. str_repeat('─', 14) . '┐' . PHP_EOL;
        echo join(PHP_EOL, $report) . PHP_EOL;
        echo '└' . str_repeat('─', $versionColumnWidth) . '┴'. str_repeat('─', 14) . '┘'. PHP_EOL . PHP_EOL;
    }

    /**
     * Initialize migrations log storage
     *
     * @param array $options Applications options
     * @throws DbException
     */
    private static function connectionSetup($options)
    {
        if (self::$_storage) {
            return;
        }

        if (isset($options['migrationsInDb']) && (bool)$options['migrationsInDb']) {
            /** @var Config $database */
            $database = $options['config']['database'];

            if (!isset($database->adapter)) {
                throw new DbException('Unspecified database Adapter in your configuration!');
            }

            $adapter = '\\Phalcon\\Db\\Adapter\\Pdo\\' . $database->adapter;

            if (!class_exists($adapter)) {
                throw new DbException('Invalid database Adapter!');
            }

            $configArray = $database->toArray();
            unset($configArray['adapter']);
            self::$_storage = new $adapter($configArray);

            if ($database->adapter === 'Mysql') {
                self::$_storage->query('SET FOREIGN_KEY_CHECKS=0');
            }

            if (!self::$_storage->tableExists(self::MIGRATION_LOG_TABLE)) {
                self::$_storage->createTable(self::MIGRATION_LOG_TABLE, null, [
                    'columns' => [
                        new Column(
                            'version',
                            [
                                'type' => Column::TYPE_VARCHAR,
                                'size' => 255,
                                'notNull' => true,
                            ]
                        ),
                        new Column(
                            'start_time',
                            [
                                'type' => Column::TYPE_TIMESTAMP,
                                'notNull' => true,
                                'default' => 'CURRENT_TIMESTAMP',
                            ]
                        ),
                        new Column(
                            'end_time',
                            [
                                'type' => Column::TYPE_TIMESTAMP,
                                'notNull' => true,
                            ]
                        )
                    ],
                    'indexes' => [
                        new Index('idx_' . self::MIGRATION_LOG_TABLE . '_version', ['version'])
                    ]
                ]);
            }

        } else {
            if (empty($options['directory'])) {
                $path = defined('BASE_PATH') ? BASE_PATH : defined('APP_PATH') ? dirname(APP_PATH) : '';
                $path = rtrim($path, '\\/') . '/.phalcon';
            } else {
                $path = rtrim($options['directory'], '\\/') . '/.phalcon';
            }
            if (!is_dir($path) && !is_writable(dirname($path))) {
                throw new \RuntimeException("Unable to write '{$path}' directory. Permission denied");
            }
            if (is_file($path)) {
                unlink($path);
                mkdir($path);
                chmod($path, 0775);
            } elseif (!is_dir($path)) {
                mkdir($path);
                chmod($path, 0775);
            }

            self::$_storage = $path . '/migration-version';

            if (!file_exists(self::$_storage)) {
                if (!is_writable($path)) {
                    throw new \RuntimeException("Unable to write '" . self::$_storage . "' file. Permission denied");
                }
                touch(self::$_storage);
            }
        }
    }

    /**
     * Get latest completed migration version
     *
     * @param array $options Applications options
     * @return ItemInterface
     */
    public static function getCurrentVersion($options)
    {
        self::connectionSetup($options);

        if (isset($options['migrationsInDb']) && (bool)$options['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $lastGoodMigration = $connection->query('SELECT * FROM '. self::MIGRATION_LOG_TABLE .' ORDER BY version DESC LIMIT 1');
            if (0 == $lastGoodMigration->numRows()) {
                return VersionCollection::createItem(null);
            } else {
                $lastGoodMigration = $lastGoodMigration->fetchArray();

                return VersionCollection::createItem($lastGoodMigration['version']);
            }
        } else {
            // Get and clean migration
            $version = file_exists(self::$_storage) ? file_get_contents(self::$_storage) : null;

            if ($version = trim($version) ?: null) {
                $version = preg_split('/\r\n|\r|\n/', $version, -1, PREG_SPLIT_NO_EMPTY);
                $version = array_pop($version);
            }

            return VersionCollection::createItem($version);
        }
    }

    /**
     * Add migration version to log
     *
     * @param array $options Applications options
     * @param string $version Migration version to store
     * @param string $startTime Migration start timestamp
     */
    public static function addCurrentVersion($options, $version, $startTime = null)
    {
        self::connectionSetup($options);

        if ($startTime === null) {
            $startTime = date("Y-m-d H:i:s");
        }
        $endTime = date("Y-m-d H:i:s");

        if (isset($options['migrationsInDb']) && (bool) $options['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $connection->insert(self::MIGRATION_LOG_TABLE, [$version, $startTime, $endTime], ['version', 'start_time', 'end_time']);
        } else {
            $currentVersions = self::getCompletedVersions($options);
            $currentVersions[(string)$version] = 1;
            $currentVersions = array_keys($currentVersions);
            sort($currentVersions);
            file_put_contents(self::$_storage, implode("\n", $currentVersions));
        }
    }

    /**
     * Remove migration version from log
     *
     * @param array $options Applications options
     * @param string $version Migration version to remove
     */
    public static function removeCurrentVersion($options, $version)
    {
        self::connectionSetup($options);

        if (isset($options['migrationsInDb']) && (bool)$options['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $connection->execute('DELETE FROM '. self::MIGRATION_LOG_TABLE .' WHERE version=\'' . $version . '\' LIMIT 1');
        } else {
            $currentVersions = self::getCompletedVersions($options);
            unset($currentVersions[(string)$version]);
            $currentVersions = array_keys($currentVersions);
            sort($currentVersions);
            file_put_contents(self::$_storage, implode("\n", $currentVersions));
        }
    }

    /**
     * Scan $_storage for all completed versions
     *
     * @param array $options Applications options
     * @return array
     */
    public static function getCompletedVersions($options)
    {
        self::connectionSetup($options);

        if (isset($options['migrationsInDb']) && (bool)$options['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $completedVersions = $connection->query('SELECT version FROM '. self::MIGRATION_LOG_TABLE .' ORDER BY version DESC')->fetchAll();
            $completedVersions = array_map(function ($version) {
                return $version['version'];
            }, $completedVersions);
        } else {
            $completedVersions = file(self::$_storage, FILE_IGNORE_NEW_LINES);
        }

        return array_flip($completedVersions);
    }
}
