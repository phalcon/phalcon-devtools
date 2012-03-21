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

$phalconToolsPath = "c:\\phalcon-tools\\";
$path = str_replace("\\", "/", getcwd());
$_SERVER['phToolsPath'] = $phalconToolsPath;

if(isset($_SERVER['argv'][1])){
	$_SERVER['argv'][1] = str_replace('-', '_', $_SERVER['argv'][1]);		
	$command = $_SERVER['argv'][1];
	$scriptPath = $phalconToolsPath."scripts\\$command.php";
	if(file_exists($scriptPath)){
		$_SERVER['argv'][] = "--directory";
		$_SERVER['argv'][] = $path;		
		require $scriptPath;
	} else {
		echo 'Phalcon: ', $command, " isn't a recognized command\n";
	}
} else {
	echo "Phalcon: incorrect usage\n";
}