<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2015 Phalcon Team (http://www.phalconphp.com)       |
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
use Phalcon\Version\TimestampedItem as TimestampedVersion;
use Phalcon\Mvc\Model\Migration as ModelMigration;
use Phalcon\Mvc\Model\Exception as ModelException;
use Phalcon\Script\ScriptException;

/**
 * Migrations Class
 *
 * @package     Phalcon
 * @copyright   Copyright (c) 2011-2015 Phalcon Team (team@phalconphp.com)
 * @license     New BSD License
 */
class Migrations
{
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
            $versionItem = VersionCollection::createItem($version.'_'.$descr);

            // Elsewhere use old-style incremental versioning
            // The version is specified
        } elseif ($version) {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
            $versionItem = VersionCollection::createItem($version);

            // The version is guessed automatically
        } else {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
            $versionItems = array();
            $iterator = new \DirectoryIterator($migrationsDir);
            foreach ($iterator as $fileInfo) {
                if ($fileInfo->isDir() && !$fileInfo->isDot()) {
                    if (preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileInfo->getFilename(), $matches)) {
                        $versionItems[] = VersionCollection::createItem($matches[0]);
                    }
                }
            }

            if (!isset($versionItems[0])) {
                $versionItem = VersionCollection::createItem('1.0.0');
            } else {
                /** @var IncrementalVersion $versionItem */
                $versionItem = VersionCollection::maximum($versionItems);
                $versionItem = $versionItem->addMinor(1);
            }
        }

        // Path to migration dir
        $migrationPath = $migrationsDir.DIRECTORY_SEPARATOR.$versionItem->getVersion();
        if (!file_exists($migrationPath)) {
            mkdir($migrationPath);
        } elseif (!$force) {
            throw new \Exception('Version '.$versionItem->getVersion().' already exists');
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
                $tableFile = $migrationPath.DIRECTORY_SEPARATOR.$tableName.'.php';
                $wasMigrated = file_put_contents(
                        $tableFile,
                        '<?php '.PHP_EOL.PHP_EOL.$migration
                    ) || $wasMigrated;
            }
        } else {
            $migration = ModelMigration::generate($versionItem->getStamp(), $tableName, $exportData);
            $tableFile = $migrationPath.DIRECTORY_SEPARATOR.$tableName.'.php';
            $wasMigrated = !!file_put_contents(
                $tableFile,
                '<?php '.PHP_EOL.PHP_EOL.$migration
            );
        }

        if (self::isConsole() && $wasMigrated) {
            print Color::success('Version '.$versionItem->getVersion().' was successfully generated').PHP_EOL;
        } elseif (self::isConsole()) {
            print Color::info('Nothing to generate. You should create tables at first.').PHP_EOL;
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
     * TODO: refactor so full migrations log is kept in the $_storage
     */
    public static function run(array $options)
    {
        // Define versioning type to be used
        if (true === $options['tsBased']) {
            VersionCollection::setType(VersionCollection::TYPE_TIMESTAMPED);
        } else {
            VersionCollection::setType(VersionCollection::TYPE_INCREMENTAL);
        }

        $migrationsDir = $options['migrationsDir'];
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

        // Read all versions
        $versionItems = array();
        $iterator = new \DirectoryIterator($migrationsDir);
        foreach ($iterator as $fileInfo) {
            if (
                $fileInfo->isDir()
                && !!$fileInfo->isDot()
                && VersionCollection::isCorrectVersion($fileInfo->getFilename())
            ) {
                $versionItems[] = VersionCollection::createItem($fileInfo->getFilename());
            }
        }

        if (!isset($versionItems[0])) {
            throw new ModelException('Migrations were not found at '.$migrationsDir);
        }

        // set default final version
        if ($finalVersion === null) {
            $finalVersion = VersionCollection::maximum($versionItems);
        }

        ModelMigration::setup($config->database);
        ModelMigration::setMigrationPath($migrationsDir);
        self::connectionSetup($options);

        $initialVersion = self::getCurrentVersion($options);
        if ($initialVersion->getStamp() == $finalVersion->getStamp()) {
            return; // nothing to do
        }

        // run migration
        $versionsBetween = VersionItem::between($initialVersion, $finalVersion, $versions);
        foreach ($versionsBetween as $k => $version) {
            $migrationStartTime = date('"Y-m-d H:i:s"');
            /** @var \Phalcon\Version\Item $version */
            if ($tableName == 'all') {
                $iterator = new \DirectoryIterator($migrationsDir.'/'.$version);
                foreach ($iterator as $fileInfo) {
                    if (!$fileInfo->isFile() || !preg_match('/\.php$/i', $fileInfo->getFilename())) {
                        continue;
                    }

                    ModelMigration::migrate($initialVersion, $version, $fileInfo->getBasename('.php'));
                }
            } else {
                ModelMigration::migrate($initialVersion, $version, $tableName);
            }

            self::setCurrentVersion($options, $version, $migrationStartTime);
            print Color::success('Version '.$version.' was successfully migrated');

            $initialVersion = $version;
        }
    }

    /**
     * Get current migration version
     *
     * @param array $options
     *
     * @return ItemInterface
     */
    public static function getCurrentVersion(array $options)
    {
        if (isset($options['config']['application']['migrationsInDb']) && (bool)$options['config']['application']['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $lastGoodMigration = $connection->query(
                'SELECT * FROM `phalcon_migrations` ORDER BY `version` DESC LIMIT 1;'
            );
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
            $version = $version && trim($version) ?: null;

            return VersionCollection::createItem($version);
        }
    }

    /**
     * Set current migrated version
     *
     * @param array         $options
     * @param ItemInterface $version
     * @param string        $startTime
     */
    public static function setCurrentVersion(array $options, ItemInterface $version, $startTime = 'NOW()')
    {
        if (isset($options['config']['application']['migrationsInDb']) && (bool)$options['config']['application']['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            // TODO: TRUNCATE to be removed on refactor
            $connection->execute('TRUNCATE TABLE `phalcon_migrations`;');
            $connection->execute(
                'INSERT INTO `phalcon_migrations` (`version`, `start_time`, `end_time`) VALUES ("'.$version.'", '.$startTime.', NOW());'
            );
        } else {
            file_put_contents(self::$_storage, (string)$version);
        }
    }

    /**
     * Setup connection
     *
     * @param array $options
     *
     * @throws DbException
     */
    private static function connectionSetup(array $options)
    {
        if (isset($options['config']['application']['migrationsInDb']) && (bool)$options['config']['application']['migrationsInDb']) {
            /** @var Config $database */
            $database = $options['config']['database'];

            if (!isset($database->adapter)) {
                throw new DbException('Unspecified database Adapter in your configuration!');
            }

            $adapter = '\\Phalcon\\Db\\Adapter\\Pdo\\'.$database->adapter;

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
                self::$_storage->execute(
                    "CREATE TABLE `phalcon_migrations` (`version` varchar(14), `start_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `end_time` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' NOT NULL);"
                );
            }

        } else {
            $path = $options['directory'];

            if (is_file($path.'.phalcon')) {
                unlink($path.'.phalcon');
                mkdir($path.'.phalcon');
                chmod($path.'.phalcon', 0775);
            } elseif (!is_dir($path.'.phalcon')) {
                mkdir($path.'.phalcon');
                chmod($path.'.phalcon', 0775);
            }

            self::$_storage = $path.'.phalcon/migration-version';
        }
    }
}
