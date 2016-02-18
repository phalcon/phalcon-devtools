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
use Phalcon\Version\Item as VersionItem;
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
     * Generate migrations
     *
     * @param array $options
     *
     * @throws \Exception
     * @todo Refactor
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
                throw new \Exception('Version ' . $originalVersion . ' is invalid');
            }

            $originalVersion = $matches[0];
            $version = new VersionItem($originalVersion, 3);
            if (file_exists($migrationsDir . '/' . $version) && !$force) {
                throw new \Exception('Version ' . $version . ' is already generated');
            }
        } else {
            $versions = array();
            $iterator = new \DirectoryIterator($migrationsDir);
            foreach ($iterator as $fileInfo) {
                if ($fileInfo->isDir()) {
                    if (preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileInfo->getFilename(), $matches)) {
                        $versions[] = new VersionItem($matches[0], 3);
                    }
                }
            }

            if (count($versions) == 0) {
                $version = new VersionItem('1.0.0');
            } else {
                $version = VersionItem::maximum($versions);
                $version = $version->addMinor(1);
            }
        }

        if (!file_exists($migrationsDir . '/' . $version)) {
            mkdir($migrationsDir . '/' . $version);
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
     *
     * TODO: refactor so full migrations log is kept in the $_storage
     */
    public static function run(array $options)
    {
        $migrationsDir = $options['migrationsDir'];
        if (!file_exists($migrationsDir)) {
            throw new ModelException('Migrations directory could not found.');
        }

        $config = $options['config'];
        if (!$config instanceof Config) {
            throw new ModelException('Internal error. Config should be instance of \Phalcon\Config');
        }

        // init ModelMigration
        if (!isset($config->database)) {
            throw new ScriptException('Cannot load database configuration');
        }

        $finalVersion = null;
        if (isset($options['version']) && $options['version'] !== null) {
            $finalVersion = new VersionItem($options['version']);
        }

        $tableName = 'all';
        if (isset($options['tableName'])) {
            $tableName = $options['tableName'];
        }

        // read all versions
        $versions = array();
        $iterator = new \DirectoryIterator($migrationsDir);
        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isDir() && preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileInfo->getFilename(), $matches)) {
                $versions[] = new VersionItem($matches[0], 3);
            }
        }

        if (count($versions) == 0) {
            throw new ModelException('Migrations were not found at ' . $migrationsDir);
        }

        // set default final version
        if ($finalVersion === null) {
            $finalVersion = VersionItem::maximum($versions);
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
                $iterator = new \DirectoryIterator($migrationsDir . '/' . $version);
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
            print Color::success('Version ' . $version . ' was successfully migrated');

            $initialVersion = $version;
        }
    }

    private static function connectionSetup($options)
    {
        if (isset($options['config']['application']['migrationsInDb']) && (bool)$options['config']['application']['migrationsInDb']) {
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
                self::$_storage->execute("CREATE TABLE `phalcon_migrations` (`version` varchar(14), `start_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, `end_time` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' NOT NULL);");
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

    public static function getCurrentVersion($options)
    {
        if (isset($options['config']['application']['migrationsInDb']) && (bool)$options['config']['application']['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $lastGoodMigration = $connection->query('SELECT * FROM `phalcon_migrations` ORDER BY `version` DESC LIMIT 1;');
            if (0 == $lastGoodMigration->numRows()) {
                return new VersionItem(null);
            } else {
                $lastGoodMigration = $lastGoodMigration->fetchArray();

                return new VersionItem($lastGoodMigration['version']);
            }
        } else {
            return new VersionItem(file_exists(self::$_storage) ? file_get_contents(self::$_storage) : null);
        }
    }

    public static function setCurrentVersion($options, $version, $startTime = 'NOW()')
    {
        if (isset($options['config']['application']['migrationsInDb']) && (bool)$options['config']['application']['migrationsInDb']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            // TODO: TRUNCATE to be removed on refactor
            $connection->execute('TRUNCATE TABLE `phalcon_migrations`;');
            $connection->execute('INSERT INTO `phalcon_migrations` (`version`, `start_time`, `end_time`) VALUES ("' . $version . '", ' . $startTime . ', NOW());');
        } else {
            file_put_contents(self::$_storage, (string)$version);
        }
    }
}
