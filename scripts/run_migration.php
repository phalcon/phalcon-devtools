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

$pToolsPath = getenv("PTOOLSPATH");
if($pToolsPath){
	chdir($pToolsPath);
}

require_once 'Builder/Builder.php';
require_once 'Model/Migration.php';
require_once 'Model/Migration/Profiler.php';
require_once 'Script/Script.php';
require_once 'Script/Color/ScriptColor.php';
require_once 'Version/Version.php';

/**
 * RunMigration
 *
 * Run database migrations
 *
 * @category 	Phalcon
 * @package 	Scripts
 * @copyright   Copyright (c) 2011-2012 Phalcon Team (team@phalconphp.com)
 * @license 	New BSD License
 * @version 	$Id$
 */
class RunMigration extends Phalcon_Script {

	public function __construct(){

		$posibleParameters = array(
			'config-ini=s' 		=> "--config-ini path \tConfiguration file [optional]",
			'migrations-dir=s'	=> "--migations-dir path \tMigrations directory [optional]",
			'directory=s'  		=> "--directory path \tDirectory where the project will be created [optional]",
			'table-name=s' 		=> "--table-name name \tTable to migrate. Default: all [optional]",
			'version=s' 		=> "--version value \tVersion to migrate [optional]",
			'force' 			=> "--force \t\tForces to overwrite existing migrations [optional]",
			'help' 				=> "--help \t\t\tShows this help"
		);

		$this->parseParameters($posibleParameters);
		if($this->isReceivedOption('help')){
			$this->showHelp($posibleParameters);
			return;
		}

		if($this->isReceivedOption('table-name')){
			$tableName = $this->getOption('table-name');
		} else {
			$tableName = 'all';
		}

		$path = '';
		if($this->isReceivedOption('directory')){
			$path = $this->getOption('directory').'/';
		}

		if($this->isReceivedOption('config-dir')){
			$config = new Phalcon_Config_Adapter_Ini($path.$this->getOption('config-dir'));
		}  else {
			$config = new Phalcon_Config_Adapter_Ini($path."app/config/config.ini");
		}
		if(!isset($config->database)){
			throw new ScriptException('Database section at configuration file could not found');
		}

		if($this->isReceivedOption('migrations-dir')){
			$migrationsDir = $path.$this->getOption('migrations-dir');
		} else {
			$migrationsDir = $path.'app/migrations';
		}

		if(!file_exists($migrationsDir)){
			throw new ScriptException('Migrations directory could not found');
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
			throw new ScriptException('Migrations were not found at '.$migrationPath);
		} else {
			$version = Phalcon_Version::maximum($versions);
		}

		if(is_file($path.'.phalcon')){
			unlink($path.'.phalcon');
			mkdir($path.'.phalcon');
		}

		if(file_exists($path.'.phalcon/migration-version')){
			$fromVersion = file_get_contents($path.'.phalcon/migration-version');
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
			echo 'Version ', $version, ' was successfully migrated';
		}

	}

}

try {
	$script = new RunMigration();
}
catch(Phalcon_Exception $e){
	ScriptColor::lookSupportedShell();
	echo ScriptColor::colorize(get_class($e).' : '.$e->getMessage()."\n", ScriptColor::LIGHT_RED);
}
catch(Exception $e){
	echo "Exception : ".$e->getMessage()."\n";
}
