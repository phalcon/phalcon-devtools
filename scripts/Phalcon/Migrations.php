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

use Phalcon\Script\Color;
use Phalcon\Version\Item as VersionItem;
use Phalcon\Mvc\Model\Migration as ModelMigration;
use Phalcon\Mvc\Model\Exception as ModelException;
use Phalcon\Db\Exception as DbException;
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
     * Migration database connection
     * @var \Phalcon\Db\AdapterInterface
     */
    protected static $_connection;

    /**
     * Configuration holder
     * @var \Phalcon\Config
     */
    protected static $_config;

    /**
     * Migration version file name
     * @var string
     */
    protected static $_migrationFid;

    /**
     * Generate migrations
     *
     * @param array $options
     *
     * @throws \Exception
     * @todo Refactor so full migrations history is kept in log
     */
    public static function generate(array $options)
    {
        $tableName = $options['tableName'];
        $exportData = $options['exportData'];
        $migrationsDir = $options['migrationsDir'];
        $originalVersion = $options['originalVersion'];
        $force = $options['force'];
        $config = $options['config'];

        if ($migrationsDir && !file_exists($migrationsDir)) {
            mkdir($migrationsDir, 0777, true);
        }

        if ($originalVersion) {
            if (!preg_match('/[a-z0-9](\.[a-z0-9]+)*/', $originalVersion, $matches)) {
                throw new \Exception("Version {$originalVersion} is invalid");
            }

            $originalVersion = $matches[0];
            $version = new VersionItem($originalVersion, 3);
            if (file_exists($migrationsDir . DIRECTORY_SEPARATOR . $version) && !$force) {
                throw new \Exception("Version {$version} is already generated");
            }
        } else {
            $versions = ModelMigration::scanForVersions($migrationsDir);

            if (!count($versions)) {
                $version = new VersionItem('1.0.0');
            } else {
                $version = VersionItem::maximum($versions);
                $version = $version->addMinor(1);
            }
        }

        if (!file_exists($migrationsDir . DIRECTORY_SEPARATOR . $version)) {
            mkdir($migrationsDir . DIRECTORY_SEPARATOR . $version);
        }

        if (!isset($config->database)) {
            throw new \Exception("Cannot load database configuration");
        }

        ModelMigration::setup($config->database);

        ModelMigration::setSkipAutoIncrement($options['no-ai']);
        ModelMigration::setMigrationPath($migrationsDir);

        if ($tableName == 'all') {
            $migrations = ModelMigration::generateAll($version, $exportData);
            foreach ($migrations as $tableName => $migration) {
                file_put_contents($migrationsDir . '/' . $version . '/' . $tableName . '.php',
                    '<?php ' . PHP_EOL . PHP_EOL . $migration);
            }
        } else {
            $migration = ModelMigration::generate($version, $tableName, $exportData);
            file_put_contents($migrationsDir . '/' . $version . '/' . $tableName . '.php',
                '<?php ' . PHP_EOL . PHP_EOL . $migration);
        }

        if (self::isConsole()) {
            print Color::success('Version ' . $version . ' was successfully generated') . PHP_EOL;
        }
    }

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
     * Run migrations
     *
     * @param array $options
     *
     * @throws Exception
     * @throws ModelException
     * @throws ScriptException
     */
    public static function run(array $options)
    {
        $path = $options['directory'];

        $migrationsDir = $options['migrationsDir'];
        if (!file_exists($migrationsDir)) {
            throw new ModelException('Migrations directory could not found.');
        }

        self::$_config = $options['config'];
        if (!self::$_config instanceof Config) {
            throw new ModelException('Internal error. Config should be instance of \Phalcon\Config');
        }

        $finalVersion = null;
        if (isset($options['version']) && $options['version'] !== null) {
            $finalVersion = new VersionItem($options['version']);
        }

        $tableName = 'all';
        if (isset($options['tableName'])) {
            $tableName = $options['tableName'];
        }

        $versions = ModelMigration::scanForVersions($migrationsDir);
        if (!count($versions)) {
            throw new ModelException("Migrations were not found at {$migrationsDir}");
        }

        // set default final version
        if (!$finalVersion) {
            $finalVersion = VersionItem::maximum($versions);
        }

        // read current version
        if (is_file($path . '.phalcon')) {
            unlink($path . '.phalcon');
            mkdir($path . '.phalcon');
            chmod($path . '.phalcon', 0775);
        }

        self::$_migrationFid = $path . '.phalcon/migration-version';

        // init ModelMigration
        if (!is_null(self::$_config->get('database'))) {
            throw new ScriptException('Cannot load database configuration');
        }

        ModelMigration::setup(self::$_config->get('database'));
        ModelMigration::setMigrationPath($migrationsDir);

        $initialVersion = self::getCurrentVersion();

        if ($initialVersion->getStamp() == $finalVersion->getStamp()) {
            return; // nothing to do
        }

        $direction = ModelMigration::DIRECTION_FORWARD;
        if ($finalVersion->getStamp() < $initialVersion->getStamp()) {
            $direction = ModelMigration::DIRECTION_BACK;
        }
        // run migration
        $lastGoodVersion = $initialVersion;
        $versionsBetween = VersionItem::between($initialVersion, $finalVersion, $versions);
        foreach ($versionsBetween as $version) {
            if ($tableName == 'all') {
                $iterator = new DirectoryIterator($migrationsDir . DIRECTORY_SEPARATOR . $version);
                foreach ($iterator as $fileInfo) {
                    if (!$fileInfo->isFile() || 0 !== strcasecmp($fileInfo->getExtension(), 'php')) {
                        continue;
                    }

                    ModelMigration::migrate($initialVersion, $version, $fileInfo->getBasename('.php'), $direction);
                }
            } else {
                ModelMigration::migrate($initialVersion, $version, $tableName, $direction);
            }

            self::setCurrentVersion((string)$lastGoodVersion, (string)$version);
            $lastGoodVersion = $version;
            print Color::success('Version ' . $version . ' was successfully migrated');

            $initialVersion = $version;
        }
    }

    /**
     * @param \Phalcon\Config $database
     * @throws DbException
     */
    public static function connSetup($database)
    {
        if (!isset($database->adapter)) {
            throw new DbException('Unspecified database Adapter in your configuration!');
        }

        $adapter = '\\Phalcon\\Db\\Adapter\\Pdo\\' . $database->adapter;

        if (!class_exists($adapter)) {
            throw new DbException('Invalid database Adapter!');
        }

        $configArray = $database->toArray();
        unset($configArray['adapter']);
        self::$_connection = new $adapter($configArray);

        if ($database->adapter == 'Mysql') {
            self::$_connection->query('SET FOREIGN_KEY_CHECKS=0');
        }

        if (!self::$_connection->tableExists('phalcon_migrations')) {
            self::$_connection->execute('CREATE TABLE `phalcon_migrations` (`version` VARCHAR(14) NOT NULL, `start_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, `end_time` TIMESTAMP NOT NULL DEFAULT "0000-00-00 00:00:00" ) DEFAULT CHARSET = utf8;');
        }
    }

    public static function getCurrentVersion()
    {
        if (!is_null(self::$_config->get('migrationsLog')) && ('database' == self::$_config->get('migrationsLog'))) {
            if (is_null(self::$_connection)) {
                self::connSetup(self::$_config->get('database'));
            }

            $initialVersion = self::$_connection->query('SELECT `version` FROM `phalcon_migrations` ORDER BY `version` DESC LIMIT 1;');
            if (0 == $initialVersion->numRows()) {
                self::$_connection->execute('INSERT INTO `phalcon_migrations` (`version`) VALUES ("0.0.0");');
                $initialVersion = new VersionItem('0.0.0');
            } else {
                $initialVersion = $initialVersion->fetch();
                $initialVersion = new VersionItem($initialVersion['version']);
            }
        } else {
            $initialVersion = new VersionItem(file_exists(self::$_migrationFid) ? file_get_contents(self::$_migrationFid) : null);
        }

        return $initialVersion;
    }

    public static function setCurrentVersion($lastVersion, $currentVersion)
    {
        if (is_null(self::$_connection)) {
            self::connSetup(self::$_config->get('database'));
        }

        if (!is_null(self::$_config->get('migrationsLog')) && ('database' == self::$_config->get('migrationsLog'))) {
            self::$_connection->execute('UPDATE `phalcon_migrations` SET `version`="' . (string)$currentVersion . '" WHERE `version`="' . (string)$lastVersion . '" LIMIT 1;');
        } else {
            file_put_contents(self::$_migrationFid, (string)$currentVersion);
        }
    }
}
