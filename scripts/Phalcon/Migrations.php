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
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon;

use Phalcon\Db\Adapter;
use Phalcon\Db\AdapterInterface;
use Phalcon\Db\Exception as DbException;
use Phalcon\Script\Color;
use Phalcon\Version\ItemCollection as VersionCollection;
use Phalcon\Version\IncrementalItem as IncrementalVersion;
use Phalcon\Version\ItemInterface;
use Phalcon\Mvc\Model\Migration as ModelMigration;
use Phalcon\Mvc\Model\Exception as ModelException;
use Phalcon\Script\ScriptException;
use DirectoryIterator;

/**
 * Migrations Class
 *
 * @package Phalcon
 */
class Migrations
{
    /**
     * @const string
     */
    const MIGRATION_LOG_TABLE = 'phalcon_migrations';

    /**
     * Filename or db connection to store migrations log
     * @var mixed
     */
    private static $_storage;

    /**
     * Check if the script is running on Console mode
     *
     * @return boolean
     */
    public static function isConsole()
    {
        return PHP_SAPI == 'cli';
    }

    /**
     * Generate migrations
     *
     * @param array $options
     *
     * @throws \Exception
     */
    public static function generate(array $options)
    {
        $tableName = $options['tableName'];
        $exportData = $options['exportData'];
        $migrationsDir = $options['migrationsDir'];
        $version = $options['version'];
        $force = $options['force'];
        $config = $options['config'];

        // Migrations directory
        if ($migrationsDir && !file_exists($migrationsDir)) {
            mkdir($migrationsDir, 0755, true);
        }

        // Use timestamped version if description is provided
        if ($descr = $options['descr']) {
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
        $migrationPath = $migrationsDir . DIRECTORY_SEPARATOR . $versionItem->getVersion();
        if (!file_exists($migrationPath)) {
            mkdir($migrationPath);
        } elseif (!$force) {
            throw new \Exception('Version ' . $versionItem->getVersion() . ' already exists');
        }

        // Try to connect to the DB
        if (!isset($config->database)) {
            throw new \Exception('Cannot load database configuration');
        }
        ModelMigration::setup($config->database);
        ModelMigration::setSkipAutoIncrement($options['noAutoIncrement']);
        ModelMigration::setMigrationPath($migrationsDir);

        $wasMigrated = false;
        if ($tableName == 'all') {
            $migrations = ModelMigration::generateAll($versionItem->getStamp(), $exportData);
            foreach ($migrations as $tableName => $migration) {
                if ($tableName == self::MIGRATION_LOG_TABLE) {
                    continue;
                }
                $tableFile = $migrationPath . DIRECTORY_SEPARATOR . $tableName . '.php';
                $wasMigrated = file_put_contents(
                        $tableFile,
                        '<?php ' . PHP_EOL . PHP_EOL . $migration
                    ) || $wasMigrated;
            }
        } else {
            $migration = ModelMigration::generate($versionItem->getStamp(), $tableName, $exportData);
            $tableFile = $migrationPath . DIRECTORY_SEPARATOR . $tableName . '.php';
            $wasMigrated = !!file_put_contents(
                $tableFile,
                '<?php ' . PHP_EOL . PHP_EOL . $migration
            );
        }

        if (self::isConsole() && $wasMigrated) {
            print Color::success('Version ' . $versionItem->getVersion() . ' was successfully generated') . PHP_EOL;
        } elseif (self::isConsole()) {
            print Color::info('Nothing to generate. You should create tables at first.') . PHP_EOL;
        }

        exit(0);
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
            throw new ModelException('Internal error. Config should be an instance of \Phalcon\Config');
        }

        // Init ModelMigration
        if (!isset($config->database)) {
            throw new ScriptException('Cannot load database configuration');
        }

        $finalVersion = null;
        if (isset($options['version']) && $options['version'] !== null) {
            $finalVersion = VersionCollection::createItem($options['version']);
        }

        $tableName = 'all';
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
        if ($initialVersion->getStamp() == $finalVersion->getStamp()) {
            print Color::info('Everything is up to date');
            exit(0);
        }

        $direction = ModelMigration::DIRECTION_FORWARD;
        if ($finalVersion->getStamp() < $initialVersion->getStamp()) {
            $direction = ModelMigration::DIRECTION_BACK;
        }

        if (ModelMigration::DIRECTION_FORWARD == $direction) {
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
            if ((ModelMigration::DIRECTION_FORWARD == $direction) && isset($completedVersions[(string)$versionItem])) {
                print Color::info('Version ' . (string)$versionItem . ' was already applied');
                continue;
            } elseif ((ModelMigration::DIRECTION_BACK == $direction) && !isset($completedVersions[(string)$versionItem])) {
                print Color::info('Version ' . (string)$versionItem . ' was already rolled back');
                continue;
            }
            if ($versionItem->getVersion() === $finalVersion->getVersion() && ModelMigration::DIRECTION_BACK == $direction) {
                break;
            }

            $migrationStartTime = date('"Y-m-d H:i:s"');
            if ($tableName == 'all') {
                $iterator = new \DirectoryIterator(
                    $migrationsDir . DIRECTORY_SEPARATOR . $versionItem->getVersion()
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
                self::removeCurrentVersion($options, (string)$versionItem);
                print Color::success('Version ' . $versionItem . ' was successfully rolled back');
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
            throw new ModelException('Internal error. Config should be an instance of \Phalcon\Config');
        }

        // Init ModelMigration
        if (!isset($config->database)) {
            throw new ScriptException('Cannot load database configuration');
        }

        $finalVersion = null;
        if (isset($options['version']) && $options['version'] !== null) {
            $finalVersion = VersionCollection::createItem($options['version']);
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

        if ($finalVersion->getStamp() < $initialVersion->getStamp()) {
            $direction = ModelMigration::DIRECTION_BACK;
            $versionItems = VersionCollection::sortDesc($versionItems);
        } else {
            $direction = ModelMigration::DIRECTION_FORWARD;
            $versionItems = VersionCollection::sortAsc($versionItems);
        }

        foreach ($versionItems as $versionItem) {
            if ((ModelMigration::DIRECTION_FORWARD == $direction) && isset($completedVersions[(string)$versionItem])) {
                print Color::success('Version ' . (string)$versionItem . ' was already applied');
                continue;
            } elseif ((ModelMigration::DIRECTION_BACK == $direction) && !isset($completedVersions[(string)$versionItem])) {
                print Color::success('Version ' . (string)$versionItem . ' was already rolled back');
                continue;
            }

            if (ModelMigration::DIRECTION_FORWARD == $direction) {
                print Color::error('Version ' . (string)$versionItem . ' was not applied');
                continue;
            } elseif (ModelMigration::DIRECTION_BACK == $direction) {
                print Color::error('Version ' . (string)$versionItem . ' was not rolled back');
                continue;
            }

        }
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

            if ($database->adapter == 'Mysql') {
                self::$_storage->query('SET FOREIGN_KEY_CHECKS=0');
            }

            if (!self::$_storage->tableExists('phalcon_migrations')) {
                self::$_storage->execute("CREATE TABLE `phalcon_migrations` (`version` VARCHAR(255), `start_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `end_time` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' NOT NULL)");
            }

        } else {
            $path = $options['directory'];

            if (is_file($path . '.phalcon')) {
                unlink($path . '.phalcon');
                mkdir($path . '.phalcon');
                chmod($path . '.phalcon', 0775);
            } elseif (!is_dir($path . '.phalcon')) {
                mkdir($path . '.phalcon');
                chmod($path . '.phalcon', 0775);
            }

            self::$_storage = $path . '.phalcon/migration-version';
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
            $lastGoodMigration = $connection->query('SELECT * FROM `phalcon_migrations` ORDER BY `version` DESC LIMIT 1');
            if (0 == $lastGoodMigration->numRows()) {
                return VersionCollection::createItem(null);
            } else {
                $lastGoodMigration = $lastGoodMigration->fetchArray();

                return VersionCollection::createItem($lastGoodMigration['version']);
            }
        } else {
            // Get and clean migration
            $version = file_exists(self::$_storage)
                ? file_get_contents(self::$_storage)
                : null;
            $version = trim($version) ?: null;

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
            $startTime = date('"Y-m-d H:i:s"');
        }
        $endTime = date('"Y-m-d H:i:s"');

        if (isset($options['migrationsInDb']) && (bool)$options['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $connection->execute('INSERT INTO `phalcon_migrations` (`version`, `start_time`, `end_time`) VALUES ("' . $version . '", ' . $startTime . ', ' . $endTime . ')');
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
            $connection->execute('DELETE FROM `phalcon_migrations` WHERE version="' . $version . '" LIMIT 1');
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
            $completedVersions = $connection->query('SELECT `version` FROM `phalcon_migrations` ORDER BY `version` DESC')->fetchAll();
            $completedVersions = array_map(function ($version) {
                return $version['version'];
            }, $completedVersions);
        } else {
            $completedVersions = file(self::$_storage);
        }

        return array_flip($completedVersions);
    }
}
