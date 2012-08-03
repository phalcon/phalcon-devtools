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
require_once 'Migrations/Migrations.php';
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
		//phalcon migrate 20121236
		$posibleParameters = array(
			'config=s' 		=> "--config path \tConfiguration file.",
			'migrations=s'	=> "--migations  \tMigrations directory.",
			'directory=s'  		=> "--directory \tDirectory where the project was created.",
			'table=s' 		=> "--table name \tTable to migrate. Default: all.",
			'version=s' 		=> "--version \tVersion to migrate.",
			'force' 			=> "--force \tForces to overwrite existing migrations.",
		);

		$this->parseParameters($posibleParameters);
		
		$parameters = $this->getParameters();
		if (isset($parameters[1]) && $parameters[1] == '?'){
			echo 
			"------------------" . PHP_EOL . 
			"|-- Example" . PHP_EOL . 
			"|-- phalcon migrate --version 201109311921 --table users" . PHP_EOL . 
			"|-----------------" . PHP_EOL . 
			"|-- Usage" . PHP_EOL . 
			"|-- phalcon migrate [options]" . PHP_EOL . 
			"|-----------------" . PHP_EOL . 
			"|-- Options:" . PHP_EOL . 
			"------------------" . PHP_EOL ;

			
			echo join(PHP_EOL, $posibleParameters) . PHP_EOL;
			return;
		}
		

		if($this->isReceivedOption('table')){
			$tableName = $this->getOption('table');
		} else {
			$tableName = 'all';
		}

		$path = '';
		if($this->isReceivedOption('directory')){
			$path = $this->getOption('directory') .'/';
		}

		if(!file_exists($path.'.phalcon')){
			throw new ScriptException("This command should be invoked inside a phalcon project directory");
		}
		
		$fileType = file_exists($path."app/config/config.ini") ? "ini" : "php";
			
		if($this->isReceivedOption('config')){
			$configPath = $path.$this->getOption('config')."/config.".$fileType;
		}  else {
			$configPath = $path."app/config/config." . $fileType;
		}
		
		if ($fileType == 'ini'){
			$config = new Phalcon_Config_Adapter_Ini($configPath);
		}else{
			include $configPath;
		}
		
		if(!isset($config->database)){
			throw new ScriptException('Database section at configuration file could not found');
		}

		if($this->isReceivedOption('migrations')){
			$migrationsDir = $path.$this->getOption('migrations');
		} else {
			$migrationsDir = $path.'app/migrations';
		}

		Phalcon_Migrations::run(array(
			'directory' => $path,
			'migrationsDir' => $migrationsDir,
			'config' => $config,
			'force' => $this->isReceivedOption('force')
		));
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
