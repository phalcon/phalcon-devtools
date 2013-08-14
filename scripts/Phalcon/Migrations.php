<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2013 Phalcon Team (http://www.phalconphp.com)       |
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

use \Phalcon\Script\Color;
use \Phalcon\Version\Item as VersionItem;
use \Phalcon\Mvc\Model\Migration as ModelMigration;

class Migrations
{

	protected static function _getConfig($path)
	{
		foreach (array('app/config/', 'config/') as $configPath) {
			if (file_exists($path . $configPath. "config.ini")) {
				return new \Phalcon\Config\Adapter\Ini($path . $configPath. "/config.ini");
			} else {
				if (file_exists($path . $configPath. "/config.php")) {
					$config = include($path . $configPath. "/config.php");
					return $config;
				}
			}
		}

		$directory = new \RecursiveDirectoryIterator('.');
		$iterator = new \RecursiveIteratorIterator($directory);
		foreach ($iterator as $f) {
			if (preg_match('/config\.php$/', $f->getPathName())) {
				$config = include($f->getPathName());
				return $config;
			} else {
				if (preg_match('/config\.ini$/', $f->getPathName())) {
					return new \Phalcon\Config\Adapter\Ini($f->getPathName());
				}
			}
		}
		throw new BuilderException('Builder can\'t locate the configuration file');
	}

	public static function generate($options)
	{

		$path = $options['directory'];
		$tableName = $options['tableName'];
		$exportData = $options['exportData'];
		$migrationsDir = $options['migrationsDir'];
		$originalVersion = $options['originalVersion'];
		$force = $options['force'];

		$config = self::_getConfig($path);

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
		    foreach ($iterator as $fileinfo) {
		        if ($fileinfo->isDir()) {
		        	if (preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileinfo->getFilename(), $matches)) {
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

		if(isset($config->database)){
			ModelMigration::setup($config->database);
		} else {
			throw new \Exception("Cannot load database configuration");
		}

		ModelMigration::setMigrationPath($migrationsDir.'/'.$version);
		if ($tableName == 'all') {
			$migrations = ModelMigration::generateAll($version, $exportData);
			foreach ($migrations as $tableName => $migration) {
				file_put_contents($migrationsDir.'/'.$version.'/'.$tableName.'.php', '<?php '.PHP_EOL.PHP_EOL.$migration);
			}
		} else {
			$migration = ModelMigration::generate($version, $tableName, $exportData);
			file_put_contents($migrationsDir.'/'.$version.'/'.$tableName.'.php', '<?php '.PHP_EOL.PHP_EOL.$migration);
		}

		print Color::success('Version '.$version.' was successfully generated').PHP_EOL;
	}

	/**
	 * Run migrations
	 */
	public static function run($options)
	{

		$path = $options['directory'];
		$migrationsDir = $options['migrationsDir'];

		if(isset($options['tableName'])){
			$tableName = $options['tableName'];
		} else {
			$tableName = 'all';
		}

		if (!file_exists($migrationsDir)) {
			throw new \Phalcon\Mvc\Model\Exception('Migrations directory could not found');
		}

		$versions = array();
		$iterator = new \DirectoryIterator($migrationsDir);
		foreach ($iterator as $fileinfo) {
			if ($fileinfo->isDir()) {
				if (preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileinfo->getFilename(), $matches)) {
					$versions[] = new VersionItem($matches[0], 3);
				}
			}
		}

		if (count($versions) == 0) {
			throw new \Phalcon\Mvc\Model\Exception('Migrations were not found at '.$migrationPath);
		} else {
			$version = VersionItem::maximum($versions);
		}

		if (is_file($path.'.phalcon')) {
			unlink($path.'.phalcon');
			mkdir($path.'.phalcon');
		}

		$migrationFid = $path.'.phalcon/migration-version';
		if (file_exists($migrationFid)) {
			$fromVersion = file_get_contents($migrationFid);
		} else {
			$fromVersion = (string) $version;
		}

		$config = self::_getConfig($path);

		if (isset($config->database)) {
			ModelMigration::setup($config->database);
		} else {
			throw new \Exception("Cannot load database configuration");
		}

		ModelMigration::setMigrationPath($migrationsDir.'/'.$version);
		$versionsBetween = VersionItem::between($fromVersion, $version, $versions);
		foreach ($versionsBetween as $version) {
			if ($tableName == 'all') {
				$iterator = new \DirectoryIterator($migrationsDir.'/'.$version);
			    foreach ($iterator as $fileinfo) {
			        if ($fileinfo->isFile()) {
			        	if (preg_match('/\.php$/', $fileinfo->getFilename())) {
			            	\Phalcon\Mvc\Model\Migration::migrateFile((string) $version, $migrationsDir.'/'.$version.'/'.$fileinfo->getFilename());
			        	}
			        }
			    }
			} else {
				$migrationPath = $migrationsDir.'/'.$version.'/'.$tableName.'.php';
				if (file_exists($migrationPath)) {
					ModelMigration::migrateFile((string) $version, $migrationPath);
				} else {
					throw new ScriptException('Migration class was not found '.$migrationPath);
				}
			}
			print Color::success('Version '.$version.' was successfully migrated').PHP_EOL;
		}

		file_put_contents($migrationFid, (string) $version);
	}

}
