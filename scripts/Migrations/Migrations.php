<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Framework                                                      |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2012 Phalcon Team (http://www.phalconphp.com)       |
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

class Phalcon_Migrations {

	public static function generate($options){

		$path = $options['directory'];
		$config = $options['config'];
		$tableName = $options['tableName'];
		$exportData = $options['exportData'];
		$migrationsDir = $options['migrationsDir'];
		$originalVersion = $options['originalVersion'];
		$force = $options['force'];

		if($migrationsDir && !file_exists($migrationsDir)){
			mkdir($migrationsDir);
		}

		if($originalVersion){
			if(!preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $originalVersion, $matches)){
				throw new ScriptException('Version '.$originalVersion.' is invalid');
			}
			$originalVersion = $matches[0];
			$version = new Phalcon_Version($originalVersion, 3);
			if(file_exists($migrationsDir.'/'.$version)){
				if(!$force){
					throw new ScriptException('Version '.$version.' is already generated');
				}
			}
		} else {
			$versions = array();
			$iterator = new DirectoryIterator($migrationsDir);
		    foreach($iterator as $fileinfo){
		        if($fileinfo->isDir()){
		        	if(preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileinfo->getFilename(), $matches)){
		            	$versions[] = new Phalcon_Version($matches[0], 3);
		        	}
		        }
		    }
		    if(count($versions)==0){
		    	$version = new Phalcon_Version('1.0.0');
		    } else {
				$version = Phalcon_Version::maximum($versions);
				$version = $version->addMinor(1);
		    }
		}
		if(!file_exists($migrationsDir.'/'.$version)){
			mkdir($migrationsDir.'/'.$version);
		}

		Phalcon_Model_Migration::setup($config->database);
		Phalcon_Model_Migration::setMigrationPath($migrationsDir.'/'.$version);
		if($tableName=='all'){
			$migrations = Phalcon_Model_Migration::generateAll($version, $exportData);
			foreach($migrations as $tableName => $migration){
				file_put_contents($migrationsDir.'/'.$version.'/'.$tableName.'.php', '<?php '.PHP_EOL.PHP_EOL.$migration);
			}
		} else {
			$migration = Phalcon_Model_Migration::generate($version, $tableName, $exportData);
			file_put_contents($migrationsDir.'/'.$version.'/'.$tableName.'.php', '<?php '.PHP_EOL.PHP_EOL.$migration);
		}

		echo 'Version ', $version, ' was successfully generated', PHP_EOL;
	}

	/**
	 * Run migrations
	 */
	public static function run($options){

		$path = $options['directory'];
		$config = $options['config'];
		$migrationsDir = $options['migrationsDir'];

		if(isset($options['tableName'])){
			$tableName = $options['tableName'];
		} else {
			$tableName = 'all';
		}

		if(!file_exists($migrationsDir)){
			throw new Phalcon_Model_Exception('Migrations directory could not found');
		}

		$versions = array();
		$iterator = new DirectoryIterator($migrationsDir);
		foreach($iterator as $fileinfo){
			if($fileinfo->isDir()){
				if(preg_match('/[a-z0-9](\.[a-z0-9]+)+/', $fileinfo->getFilename(), $matches)){
					$versions[] = new Phalcon_Version($matches[0], 3);
				}
			}
		}
		if(count($versions)==0){
			throw new Phalcon_Model_Exception('Migrations were not found at '.$migrationPath);
		} else {
			$version = Phalcon_Version::maximum($versions);
		}

		if(is_file($path.'.phalcon')){
			unlink($path.'.phalcon');
			mkdir($path.'.phalcon');
		}

		$migrationFid = $path.'.phalcon/migration-version';
		if(file_exists($migrationFid)){
			$fromVersion = file_get_contents($migrationFid);
		} else {
			$fromVersion = (string) $version;
		}

		Phalcon_Model_Migration::setup($config->database);
		Phalcon_Model_Migration::setMigrationPath($migrationsDir.'/'.$version);
		$versionsBetween = Phalcon_Version::between($fromVersion, $version, $versions);
		foreach($versionsBetween as $version){
			if($tableName=='all'){
				$iterator = new DirectoryIterator($migrationsDir.'/'.$version);
			    foreach($iterator as $fileinfo){
			        if($fileinfo->isFile()){
			        	if(preg_match('/\.php$/', $fileinfo->getFilename())){
			            	Phalcon_Model_Migration::migrateFile((string) $version, $migrationsDir.'/'.$version.'/'.$fileinfo->getFilename());
			        	}
			        }
			    }
			} else {
				$migrationPath = $migrationsDir.'/'.$version.'/'.$tableName.'.php';
				if(file_exists($migrationPath)){
					Phalcon_Model_Migration::migrateFile((string) $version, $migrationPath);
				} else {
					throw new ScriptException('Migration class was not found '.$migrationPath);
				}
			}
			echo 'Version ', $version, ' was successfully migrated', PHP_EOL;
		}

		file_put_contents($migrationFid, (string) $version);
	}

}