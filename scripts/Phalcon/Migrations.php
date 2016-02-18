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
use Phalcon\Script\ScriptException;
use DirectoryIterator;
use Phalcon\Version\TimestampItem;

/**
 * Migrations Class
 *
 * @package Phalcon
 */
class Migrations
{
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
     * @todo Refactor
     */
    public static function generate(array $options)
    {
        $tableName = $options['tableName'];
        $exportData = $options['exportData'];
        $migrationsDir = $options['migrationsDir'];
        $version = $options['version'];
        $descr = $options['descr'];
        $force = $options['force'];
        $config = $options['config'];

        if ($migrationsDir && !file_exists($migrationsDir)) {
            mkdir($migrationsDir, 0755, true);
        }

        // Timestamp-base versioning
        if ($descr) {
            $version = (string)(int)(microtime(true) * pow(10, 6));
            $cleanDescr = trim(preg_replace('#[^0-9a-z]+#', '_', strtolower($descr)), '_');
            $versionName = sprintf('%s_%s', $version, $cleanDescr);

            // Old-style versioning with explict given version
        } elseif ($version) {
            if (!preg_match('/[a-z0-9](\.[a-z0-9]+)*/', $version, $matches)) {
                throw new \Exception("Version {$version} is invalid");
            }
            $versionItem = new VersionItem($matches[0], 3);
            $versionName = (string)$versionItem->getVersion();
            if (file_exists($migrationsDir.DIRECTORY_SEPARATOR.$version) && !$force) {
                throw new \Exception("Version {$version} is already generated");
            }

            // Old-style versioning with generated version
        } else {
            $versionItems = ModelMigration::scanForVersions($migrationsDir);
            if (!count($versionItems)) {
                $versionItem = new VersionItem('1.0.0');
                $versionName = (string)$versionItem->getVersion();
            } else {
                $versionItem = VersionItem::maximum($versionItems);
                $versionName = (string)$versionItem->addMinor(1);
            }

        }

        // Create directory for current migration files
        $currentMigrationDir = $migrationsDir.DIRECTORY_SEPARATOR.$versionName;
        if (!file_exists($currentMigrationDir)) {
            mkdir($currentMigrationDir);
        }

        // Try to connect to the DB
        if (!isset($config->database)) {
            throw new \Exception("Cannot load database configuration");
        }

        ModelMigration::setup($config->database);
        ModelMigration::setSkipAutoIncrement($options['no-ai']);
        ModelMigration::setMigrationPath($migrationsDir);

        // Generate
        $isMigrated = false;
        if ($tableName == 'all') {
            $migrations = ModelMigration::generateAll($versionName, $exportData);
            $isMigrated = !!$migrations;
            foreach ($migrations as $tableName => $migration) {
                $filename = $currentMigrationDir.DIRECTORY_SEPARATOR.$tableName.'.php';
                file_put_contents($filename, '<?php '.PHP_EOL.PHP_EOL.$migration);
            }
        } else {
            $migration = ModelMigration::generate($versionName, $tableName, $exportData);
            $filename = $currentMigrationDir.DIRECTORY_SEPARATOR.$tableName.'.php';
            $isMigrated = !!$migration
                && file_put_contents($filename, '<?php '.PHP_EOL.PHP_EOL.$migration);
        }

        // Print status
        if ($isMigrated && self::isConsole()) {
            print Color::success('Version '.$versionName.' was successfully generated').PHP_EOL;
        } elseif (self::isConsole()) {
            print Color::success('Nothing to generate (maybe the tables aren\'t created yet)').PHP_EOL;
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
     */
    public static function run(array $options)
    {
        $path = $options['directory'];
        $isTimestampedVersion = !!$options['new']; // New timestamp based version naming

        $migrationsDir = $options['migrationsDir'];
        if (!file_exists($migrationsDir)) {
            throw new ModelException('Migrations directory could not found.');
        }

        $config = $options['config'];
        if (!$config instanceof Config) {
            throw new ModelException('Internal error. Config should be instance of \Phalcon\Config');
        }

        $tableName = 'all';
        if (isset($options['tableName'])) {
            $tableName = $options['tableName'];
        }

        // Limitary version
        $finalVersion = null;
        if ($isTimestampedVersion) {
            $finalVersion = new TimestampItem($options['version']);
        } elseif (!$isTimestampedVersion && isset($options['version']) && $options['version'] !== null) {
            $finalVersion = new VersionItem($options['version']);
        }

        var_dump($finalVersion->isFullVersion());

        $versions = ModelMigration::scanForVersions($migrationsDir);
        if (!count($versions)) {
            throw new ModelException("Migrations were not found at {$migrationsDir}");
        }

        // set default final version
        if (!$finalVersion) {
            $finalVersion = VersionItem::maximum($versions);
        }

        // read current version
        if (is_file($path.'.phalcon')) {
            unlink($path.'.phalcon');
            mkdir($path.'.phalcon');
        }

        $migrationFid = $path.'.phalcon/migration-version';
        $initialVersion = new VersionItem(file_exists($migrationFid) ? file_get_contents($migrationFid) : null);

        if ($initialVersion->getStamp() == $finalVersion->getStamp()) {
            return; // nothing to do
        }

        // init ModelMigration
        if (!isset($config->database)) {
            throw new ScriptException('Cannot load database configuration');
        }

        ModelMigration::setup($config->database);
        ModelMigration::setMigrationPath($migrationsDir);

        $direction = ModelMigration::DIRECTION_FORWARD;
        if ($finalVersion->getStamp() < $initialVersion->getStamp()) {
            $direction = ModelMigration::DIRECTION_BACK;
        }
        // run migration
        $versionsBetween = VersionItem::between($initialVersion, $finalVersion, $versions);
        foreach ($versionsBetween as $version) {
            if ($tableName == 'all') {
                $iterator = new DirectoryIterator($migrationsDir.DIRECTORY_SEPARATOR.$version);
                foreach ($iterator as $fileinfo) {
                    if (!$fileinfo->isFile() || 0 !== strcasecmp($fileinfo->getExtension(), 'php')) {
                        continue;
                    }

                    ModelMigration::migrate($initialVersion, $version, $fileinfo->getBasename('.php'), $direction);
                }
            } else {
                ModelMigration::migrate($initialVersion, $version, $tableName, $direction);
            }

            file_put_contents($migrationFid, (string)$version);
            print Color::success('Version '.$version.' was successfully migrated');

            $initialVersion = $version;
        }
    }
}
