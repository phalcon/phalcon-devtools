#!/usr/bin/env php
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

use Phalcon\Script;
use Phalcon\Script\Color;

if(!extension_loaded('phalcon')){
	die('Phalcon extension isn\'t installed, follow these instructions to install it: http://phalconphp.com/documentation/install' . PHP_EOL);
}

if (!defined('TEMPLATES_PATH')) {
	define('TEMPLATES_PATH', __DIR__ . '/templates');
}

set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/scripts');
spl_autoload_register(function($class) {
	include str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
});

$vendor = sprintf('Phalcon DevTools (%s)', Script::VERSION);
print PHP_EOL . Color::colorize($vendor, Color::FG_GREEN, Color::AT_BOLD) . PHP_EOL . PHP_EOL;

$script = new Script;
$script->attach(new \Phalcon\Command\Commands);
$script->attach(new \Phalcon\Command\Controller);
$script->attach(new \Phalcon\Command\Project);
$script->attach(new \Phalcon\Command\Scaffold);

try {
	$script->run();
}
catch (\Phalcon\Exception $e) {
	print Color::error($e->getMessage()) . PHP_EOL;
}
catch (\Exception $e) {
	print Color::error($e->getMessage()) . PHP_EOL;
}