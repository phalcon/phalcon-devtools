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
use Phalcon\Console\OptionStack;
use Phalcon\Mvc\Model\Migration\TableAware\ListTablesIterator;
use Phalcon\Mvc\Model\Migration\TableAware\ListTablesDb;

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
    protected static $storage;

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
        $optionStack = new OptionStack();
        $listTables = new ListTablesDb();
        $optionStack->setOptions($options);
        $optionStack->setDefaultOption('version', null);
        $optionStack->setDefaultOption('descr', null);
        $optionStack->setDefaultOption('noAutoIncrement', null);
        $optionStack->setDefaultOption('verbose', false);

        // Migrations directory
        if ($optionStack->getOption('migrationsDir') && !file_exists($optionStack->getOption('migrationsDir'))) {
            mkdir($optionStack->getOption('migrationsDir'), 0755, true);
        }

        $versionItem = $optionStack->getVersionNameGeneratingMigration();

        // Path to migration dir
        $migrationPath = rtrim($optionStack->getOption('migrationsDir'), '\\/') .
            DIRECTORY_SEPARATOR . $versionItem->getVersion();

        if (!file_exists($migrationPath)) {
            if (is_writable(dirname($migrationPath)) && !$optionStack->getOption('verbose')) {
                mkdir($migrationPath);
            } elseif (!is_writable(dirname($migrationPath))) {
                throw new \RuntimeException("Unable to write '{$migrationPath}' directory. Permission denied");
            }
        } elseif (!$optionStack->getOption('force')) {
            throw new \LogicException('Version ' . $versionItem->getVersion() . ' already exists');
        }

        // Try to connect to the DB
        if (!isset($optionStack->getOption('config')->database)) {
            throw new \RuntimeException('Cannot load database configuration');
        }

        ModelMigration::setup($optionStack->getOption('config')->database, $optionStack->getOption('verbose'));
        ModelMigration::setSkipAutoIncrement($optionStack->getOption('noAutoIncrement'));
        ModelMigration::setMigrationPath($optionStack->getOption('migrationsDir'));

        $wasMigrated = false;
        if ($optionStack->getOption('tableName') === '@') {
            $migrations = ModelMigration::generateAll($versionItem, $optionStack->getOption('exportData'));
            if (!$optionStack->getOption('verbose')) {
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
            }
        } else {
            $prefix = $optionStack->getPrefixOption($optionStack->getOption('tableName'));
            if (!empty($prefix)) {
                $optionStack->setOption('tableName', $listTables->listTablesForPrefix($prefix));
            }

            if ($optionStack->getOption('tableName') == '') {
                print Color::info('No one table is created. You should create tables first.') . PHP_EOL;
                return;
            }

            $tables = explode(',', $optionStack->getOption('tableName'));
            foreach ($tables as $table) {
                $migration = ModelMigration::generate($versionItem, $table, $optionStack->getOption('exportData'));
                if (!$optionStack->getOption('verbose')) {
                    $tableFile = $migrationPath . DIRECTORY_SEPARATOR . $table . '.php';
                    $wasMigrated = file_put_contents(
                        $tableFile,
                        '<?php ' . PHP_EOL . PHP_EOL . $migration
                    );
                }
            }
        }

        if (self::isConsole() && $wasMigrated) {
            print Color::success('Version ' . $versionItem->getVersion() . ' was successfully generated') . PHP_EOL;
        } elseif (self::isConsole() && !$optionStack->getOption('verbose')) {
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
        $optionStack = new OptionStack();
        $listTables = new ListTablesIterator();
        $optionStack->setOptions($options);
        $optionStack->setDefaultOption('verbose', false);

        // Define versioning type to be used
        if (isset($options['tsBased']) && $optionStack->getOption('tsBased') === true) {
            VersionCollection::setType(VersionCollection::TYPE_TIMESTAMPED);
        } else {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
        }

        $migrationsDir = rtrim($optionStack->getOption('migrationsDir'), '\\/');
        if (!file_exists($migrationsDir)) {
            throw new ModelException('Migrations directory was not found.');
        }

        if (!$optionStack->getOption('config') instanceof Config) {
            throw new ModelException('Internal error. Config should be an instance of ' . Config::class);
        }

        // Init ModelMigration
        if (!isset($optionStack->getOption('config')->database)) {
            throw new ScriptException('Cannot load database configuration');
        }

        $finalVersion = null;
        if (isset($options['version']) && $optionStack->getOption('version') !== null) {
            $finalVersion = VersionCollection::createItem($options['version']);
        }

        $optionStack->setOption('tableName', $options['tableName'], '@');

        $versionItems = ModelMigration::scanForVersions($migrationsDir);

        if (!isset($versionItems[0])) {
            if (php_sapi_name() == 'cli') {
                fwrite(STDERR, PHP_EOL . 'Migrations were not found at ' . $migrationsDir . PHP_EOL);
                exit;
            } else {
                throw new ModelException('Migrations were not found at ' . $migrationsDir);
            }
        }

        // Set default final version
        if ($finalVersion === null) {
            $finalVersion = VersionCollection::maximum($versionItems);
        }

        ModelMigration::setup($optionStack->getOption('config')->database, $optionStack->getOption('verbose'));
        ModelMigration::setMigrationPath($migrationsDir);
        self::connectionSetup($optionStack->getOptions());

        /** @var \Phalcon\Version\IncrementalItem $initialVersion */
        $initialVersion = self::getCurrentVersion($optionStack->getOptions());
        $completedVersions = self::getCompletedVersions($optionStack->getOptions());

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
            /*
             * If we migrate downs,
             * we should go from the last migration to revert some migrations which may have been missed
             */
            $versionItemsTmp = VersionCollection::sortDesc(array_merge($versionItems, [$initialVersion]));
            $initialVersion = $versionItemsTmp[0];
        }

        // Run migration
        $versionsBetween = VersionCollection::between($initialVersion, $finalVersion, $versionItems);
        $prefix = $optionStack->getPrefixOption($optionStack->getOption('tableName'));

        /** @var \Phalcon\Version\IncrementalItem $versionItem */
        foreach ($versionsBetween as $versionItem) {
            // If we are rolling back, we skip migrating when initialVersion is the same as current
            if ($initialVersion->getVersion() === $versionItem->getVersion() &&
                ModelMigration::DIRECTION_BACK === $direction) {
                continue;
            }

            if ((ModelMigration::DIRECTION_FORWARD === $direction) && isset($completedVersions[(string)$versionItem])) {
                print Color::info('Version ' . (string)$versionItem . ' was already applied');
                continue;
            } elseif ((ModelMigration::DIRECTION_BACK === $direction) &&
                !isset($completedVersions[(string)$initialVersion])) {
                print Color::info('Version ' . (string)$initialVersion . ' was already rolled back');
                $initialVersion = $versionItem;
                continue;
            }

            if ($initialVersion->getVersion() === $finalVersion->getVersion() &&
                ModelMigration::DIRECTION_BACK === $direction) {
                break;
            }

            $migrationStartTime = date("Y-m-d H:i:s");

            // Directory depends on Forward or Back Migration
            $iterator = new DirectoryIterator(
                $migrationsDir . DIRECTORY_SEPARATOR . (ModelMigration::DIRECTION_BACK === $direction ?
                    $initialVersion->getVersion() : $versionItem->getVersion())
            );

            if ($optionStack->getOption('tableName') === '@') {
                foreach ($iterator as $fileInfo) {
                    if (!$fileInfo->isFile() || 0 !== strcasecmp($fileInfo->getExtension(), 'php')) {
                        continue;
                    }
                    ModelMigration::migrate($initialVersion, $versionItem, $fileInfo->getBasename('.php'));
                }
            } else {
                if (!empty($prefix)) {
                    $optionStack->setOption('tableName', $listTables->listTablesForPrefix($prefix, $iterator));
                }

                $tables =  explode(',', $optionStack->getOption('tableName'));
                foreach ($tables as $tableName) {
                    ModelMigration::migrate($initialVersion, $versionItem, $tableName);
                }
            }

            if (ModelMigration::DIRECTION_FORWARD == $direction) {
                self::addCurrentVersion($optionStack->getOptions(), (string)$versionItem, $migrationStartTime);
                print Color::success('Version ' . $versionItem . ' was successfully migrated');
            } else {
                self::removeCurrentVersion($optionStack->getOptions(), (string)$initialVersion);
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
        if (self::$storage) {
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
            self::$storage = new $adapter($configArray);

            if ($database->adapter === 'Mysql') {
                self::$storage->query('SET FOREIGN_KEY_CHECKS=0');
            }

            if (!self::$storage->tableExists(self::MIGRATION_LOG_TABLE)) {
                self::$storage->createTable(self::MIGRATION_LOG_TABLE, null, [
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
                                'default' => 'CURRENT_TIMESTAMP',
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

            self::$storage = $path . '/migration-version';

            if (!file_exists(self::$storage)) {
                if (!is_writable($path)) {
                    throw new \RuntimeException("Unable to write '" . self::$storage . "' file. Permission denied");
                }
                touch(self::$storage);
            }
        }
    }

    /**
     * Get latest completed migration version
     *
     * @param array $options Applications options
     * @return \Phalcon\Version\IncrementalItem|\Phalcon\Version\TimestampedItem.
     */
    public static function getCurrentVersion($options)
    {
        self::connectionSetup($options);

        if (isset($options['migrationsInDb']) && (bool)$options['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$storage;
            $query = 'SELECT * FROM '. self::MIGRATION_LOG_TABLE .' ORDER BY version DESC LIMIT 1';
            $lastGoodMigration = $connection->query($query);

            if (0 == $lastGoodMigration->numRows()) {
                return VersionCollection::createItem(null);
            } else {
                $lastGoodMigration = $lastGoodMigration->fetchArray();

                return VersionCollection::createItem($lastGoodMigration['version']);
            }
        } else {
            // Get and clean migration
            $version = file_exists(self::$storage) ? file_get_contents(self::$storage) : null;

            if ($version = trim($version) ?: null) {
                $version = preg_split('/\r\n|\r|\n/', $version, -1, PREG_SPLIT_NO_EMPTY);
                natsort($version);
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
            $connection = self::$storage;
            $connection->insert(
                self::MIGRATION_LOG_TABLE,
                [$version, $startTime, $endTime],
                ['version', 'start_time', 'end_time']
            );
        } else {
            $currentVersions = self::getCompletedVersions($options);
            $currentVersions[$version] = 1;
            $currentVersions = array_keys($currentVersions);
            sort($currentVersions);
            file_put_contents(self::$storage, implode("\n", $currentVersions));
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
            $connection = self::$storage;
            $connection->execute('DELETE FROM '. self::MIGRATION_LOG_TABLE .' WHERE version=\'' . $version . '\'');
        } else {
            $currentVersions = self::getCompletedVersions($options);
            unset($currentVersions[$version]);
            $currentVersions = array_keys($currentVersions);
            sort($currentVersions);
            file_put_contents(self::$storage, implode("\n", $currentVersions));
        }
    }

    /**
     * Scan $storage for all completed versions
     *
     * @param array $options Applications options
     * @return array
     */
    public static function getCompletedVersions($options)
    {
        self::connectionSetup($options);

        if (isset($options['migrationsInDb']) && (bool)$options['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$storage;
            $query = 'SELECT version FROM ' . self::MIGRATION_LOG_TABLE . ' ORDER BY version DESC';
            $completedVersions = $connection->query($query)->fetchAll();
            $completedVersions = array_map(function ($version) {
                return $version['version'];
            }, $completedVersions);
        } else {
            $completedVersions = file(self::$storage, FILE_IGNORE_NEW_LINES);
        }

        return array_flip($completedVersions);
    }
}
