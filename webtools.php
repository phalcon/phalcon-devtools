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

require 'webtools.config.php';

if(PHP_OS=="WINNT"){
	$path = str_replace("\\", "/", getcwd())."/..";
} else {
	$path = getcwd().'/..';
}

chdir(PTOOLSPATH);

if(!extension_loaded('phalcon')){
	die('Phalcon extension isn\'t installed, follow these instructions to install it: http://phalconphp.com/documentation/install'.PHP_EOL);
}

require 'scripts/WebTools/WebTools.php';

Phalcon_WebTools::main($path);
