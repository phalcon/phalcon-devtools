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

error_reporting(E_ALL);

$phalconToolsPath = getenv("PTOOLSPATH");
if(!$phalconToolsPath){
	die("Phalcon: PTOOLSPATH environment variable isn't set\n");
}

if(PHP_OS=="WINNT"){
	$path = str_replace("\\", "/", getcwd());
} else {
	$path = getcwd();
}

if(!extension_loaded('phalcon')){
	die('Phalcon extension isn\'t installed, follow these instructions to install it: http://phalconphp.com/documentation/install'.PHP_EOL);
}

if(!file_exists($phalconToolsPath."scripts")){
	die('Phalcon sripts PATH does not exist, check your PTOOLSPATH env variable ('.$phalconToolsPath.'scripts)'.PHP_EOL);	
}

if(isset($_SERVER['argv'][1])){
	if($_SERVER['argv'][1]=='commands'){
		echo 'Available commands:', PHP_EOL;
		$directory = new DirectoryIterator($phalconToolsPath."scripts");
		foreach($directory as $file){
			if(!$file->isDir()){
				$command = str_replace('.php', '', $file->getFileName());
				$command = str_replace('_', '-', $command);
				echo $command, PHP_EOL;
			}
		}
	} else {
		$_SERVER['argv'][1] = str_replace('-', '_', $_SERVER['argv'][1]);
		$command = $_SERVER['argv'][1];
		$scriptPath = $phalconToolsPath."scripts".DIRECTORY_SEPARATOR.$command.".php";
		if(file_exists($scriptPath)){
			$_SERVER['argv'][] = "--directory";
			$_SERVER['argv'][] = $path;
			require $scriptPath;
		} else {
			die('Phalcon: '.$command." isn't a recognized command\n");
		}
	}
} else {
	die("Phalcon: incorrect usage\n");
}
