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
use Phalcon\Version\Item as VersionItem;
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
                file_put_contents($migrationsDir . DIRECTORY_SEPARATOR . $version . DIRECTORY_SEPARATOR . $tableName . '.php',
                    '<?php ' . PHP_EOL . PHP_EOL . $migration);
            }
        } else {
            $migration = ModelMigration::generate($version, $tableName, $exportData);
            file_put_contents($migrationsDir . DIRECTORY_SEPARATOR . $version . DIRECTORY_SEPARATOR . $tableName . '.php',
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

        $versions = ModelMigration::scanForVersions($migrationsDir);
        if (!count($versions)) {
            throw new ModelException("Migrations were not found at {$migrationsDir}");
        }

        // set default final version
        if (!$finalVersion) {
            $finalVersion = VersionItem::maximum($versions);
        }

        ModelMigration::setup($config->database);
        ModelMigration::setMigrationPath($migrationsDir);

        self::connectionSetup($options);
        $initialVersion = self::getCurrentVersion($options);
        $completedVersions = self::getCompletedVersions($options);

        $direction = ModelMigration::DIRECTION_FORWARD;
        if ($finalVersion->getStamp() < $initialVersion->getStamp()) {
            $direction = ModelMigration::DIRECTION_BACK;
        }

        if ($initialVersion->getStamp() == $finalVersion->getStamp()) {
            return; // nothing to do
        }

        if ($initialVersion->getStamp() < $finalVersion->getStamp()) {
            $versions = VersionItem::sortAsc($versions);
            $initialVersion = $versions[0];
        } else {
            $versions = VersionItem::sortDesc($versions);
            $initialVersion = $versions[0];
        }

        // run migration
        $versionsBetween = VersionItem::between($initialVersion, $finalVersion, $versions);
        foreach ($versionsBetween as $version) {
            if ((ModelMigration::DIRECTION_FORWARD == $direction) && isset($completedVersions[(string)$version])) {
                print Color::info('Version ' . (string)$version . ' was already applied');
                continue;
            } elseif ((ModelMigration::DIRECTION_BACK == $direction) && !isset($completedVersions[(string)$version])) {
                print Color::info('Version ' . (string)$version . ' was already rolled back');
                continue;
            }

            $migrationStartTime = date('"Y-m-d H:i:s"');
            if ($tableName == 'all') {
                $iterator = new DirectoryIterator($migrationsDir . DIRECTORY_SEPARATOR . $version);
                foreach ($iterator as $fileinfo) {
                    if (!$fileinfo->isFile() || 0 !== strcasecmp($fileinfo->getExtension(), 'php')) {
                        continue;
                    }

                    ModelMigration::migrate($initialVersion, $version, $fileinfo->getBasename('.php'), $direction);
                }
            } else {
                ModelMigration::migrate($initialVersion, $version, $tableName, $direction);
            }

            if (ModelMigration::DIRECTION_FORWARD == $direction) {
                self::addCurrentVersion($options, (string)$version, $migrationStartTime);
                print Color::success('Version ' . $version . ' was successfully migrated');
            } else {
                self::removeCurrentVersion($options, (string)$version);
                print Color::success('Version ' . $version . ' was successfully rolled back');
            }

            $initialVersion = $version;
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
        if (isset($options['migrationsLog']) && (bool)$options['migrationsLog']) {
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

    /**
     * Get latest completed migration version
     *
     * @param array $options Applications options
     * @return VersionItem
     */
    public static function getCurrentVersion($options)
    {
        if (isset($options['migrationsLog']) && (bool)$options['migrationsLog']) {
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

    /**
     * Add migration version to log
     *
     * @param array $options Applications options
     * @param string $version Migration version to store
     * @param string $startTime Migration start timestamp
     */
    public static function addCurrentVersion($options, $version, $startTime = 'NOW()')
    {
        if (isset($options['migrationsLog']) && (bool)$options['migrationsLog']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $connection->execute('INSERT INTO `phalcon_migrations` (`version`, `start_time`, `end_time`) VALUES ("' . $version . '", ' . $startTime . ', NOW());');
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
        if (isset($options['migrationsLog']) && (bool)$options['migrationsLog']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $connection->execute('DELETE FROM `phalcon_migrations` WHERE version="' . $version . '" LIMIT 1;');
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
        if (isset($options['migrationsLog']) && (bool)$options['migrationsLog']) {
            /** @var AdapterInterface $connection */
            $connection = self::$_storage;
            $completedVersions = $connection->query('SELECT `version` FROM `phalcon_migrations` ORDER BY `version` DESC;')->fetchAll();
            $completedVersions = array_map(function ($version) {
                return $version['version'];
            }, $completedVersions);
        } else {
            $completedVersions = file(self::$_storage);
        }

        return array_flip($completedVersions);
    }

    /**
     * Scan for all versions
     *
     * @param string $dir Directory to scan
     * @return array
     */
    protected static function scanForVersions($dir)
    {
        $versions = [];
        $iterator = new DirectoryIterator($dir);

        foreach ($iterator as $fileinfo) {
            if (!$fileinfo->isDir() || $fileinfo->isDot()) {
                continue;
            }

            preg_match('#[a-z0-9](?:\.[a-z0-9]+)+#', $fileinfo->getFilename(), $matches);
            if (isset($matches[0])) {
                $versions[] = new VersionItem($matches[0], 3);
            }
        }

        return $versions;

    }
}
