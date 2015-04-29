<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2014 Phalcon Team (http://www.phalconphp.com)       |
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
  +------------------------------------------------------------------------+
*/

namespace Phalcon;

use Phalcon\Script\Color;
use Phalcon\Version\Item as VersionItem;
use Phalcon\Mvc\Model\Migration as ModelMigration;

class Migrations
{

    /**
     * Generate migrations
     *
     * @param $options
     *
     * @throws \Exception
     */
    public static function generate($options)
    {

        $path = $options['directory'];
        $tableName = $options['tableName'];
        $exportData = $options['exportData'];
        $migrationsDir = $options['migrationsDir'];
        $originalVersion = $options['originalVersion'];
        $force = $options['force'];
        $config = $options['config'];

        if ($migrationsDir && !file_exists($migrationsDir)) {
            mkdir($migrationsDir);
        }

        if ($originalVersion) {

            if (!preg_match('/[a-z0-9](\.[a-z0-9]+)*/', $originalVersion, $matches)) {
                throw new \Exception('Version '.$originalVersion.' is invalid');
            }

            $originalVersion = $matches[0];
            $version = new VersionItem($originalVersion, 3);
            if (file_exists($migrationsDir.'/'.$version)) {
                if (!$force) {
                    throw new \Exception('Version '.$version.' is already generated');
                }
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

        if (!file_exists($migrationsDir.'/'.$version)) {
            mkdir($migrationsDir.'/'.$version);
        }

        if (isset($config->database)) {
            ModelMigration::setup($config->database);
        } else {
            throw new \Exception("Cannot load database configuration");
        }

        ModelMigration::setMigrationPath($migrationsDir);
        if ($tableName == 'all') {
            $migrations = ModelMigration::generateAll($version, $exportData);
            foreach ($migrations as $tableName => $migration) {
                file_put_contents($migrationsDir.'/'.$version.'/'.$tableName.'.php', '<?php '.PHP_EOL.PHP_EOL.$migration);
            }
        } else {
            $migration = ModelMigration::generate($version, $tableName, $exportData);
            file_put_contents($migrationsDir.'/'.$version.'/'.$tableName.'.php', '<?php '.PHP_EOL.PHP_EOL.$migration);
        }

        if ( self::isConsole() ) {

            print Color::success('Version '.$version.' was successfully generated').PHP_EOL;
        }
    }

    /**
     * Check if the script is running on Console mode
     *
     * @return boolean
     */
    public static function isConsole()
    {
        return !isset($_SERVER['SERVER_SOFTWARE']);
    }

    /**
     * Run migrations
     */
    public static function run($options)
    {
        $path = $options['directory'];

        $migrationsDir = $options['migrationsDir'];
        if (!file_exists($migrationsDir)) {
            throw new \Phalcon\Mvc\Model\Exception('Migrations directory could not found');
        }

        $config = $options['config'];

        if (isset($options['version']) && $options['version'] !== null) {
            $finalVersion = new VersionItem($options['version']);
        } else {
            $finalVersion = null;
        }

        if (isset($options['tableName'])) {
            $tableName = $options['tableName'];
        } else {
            $tableName = 'all';
        }

        // read all versions
        $versions = array();
        $iterator = new \DirectoryIterator($migrationsDir);
        foreach ($iterator as $fileinfo) {
            if ($fileinfo->isDir() && preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileinfo->getFilename(), $matches)) {
                $versions[] = new VersionItem($matches[0], 3);
            }
        }
        if (count($versions) == 0) {
            throw new \Phalcon\Mvc\Model\Exception('Migrations were not found at '.$migrationsDir);
        }

        // set default final version
        if ($finalVersion === null){
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
        if (isset($config->database)) {
            ModelMigration::setup($config->database);
        } else {
            throw new \Exception("Cannot load database configuration");
        }
        ModelMigration::setMigrationPath($migrationsDir) ;

        // run migration
        $versionsBetween = VersionItem::between($initialVersion, $finalVersion, $versions);
        foreach ($versionsBetween as $k=>$version) {
            if ($k > 0) { // skip the initial version
                if ($tableName == 'all') {
                    $iterator = new \DirectoryIterator($migrationsDir . '/' . $version);
                    foreach ($iterator as $fileinfo) {
                        if ($fileinfo->isFile() && preg_match('/\.php$/', $fileinfo->getFilename())) {
                            ModelMigration::migrate($fromVersion, $version, $fileinfo->getBasename('.php'));
                        }
                    }
                } else {
                    ModelMigration::migrate($fromVersion, $version, $tableName);
                }

                file_put_contents($migrationFid, (string)$version);
                print Color::success('Version ' . $version . ' was successfully migrated');
            }
            $fromVersion = $version;
        }

    }

}

