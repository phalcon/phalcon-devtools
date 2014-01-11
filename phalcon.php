#!/usr/bin/env php
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

error_reporting(E_ALL);

use Phalcon\Script;
use Phalcon\Version;
use Phalcon\Script\Color;
use Phalcon\Commands\CommandsListener;
use Phalcon\Loader;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Exception as PhalconException;

try {

    $extensionLoaded = true;
    if (!extension_loaded('phalcon')) {
        $extensionLoaded = false;
        throw new Exception('Phalcon extension isn\'t installed, follow these instructions to install it: http://docs.phalconphp.com/en/latest/reference/install.html');
    }

    $loader = new Loader();

    $loader->registerDirs(array(
        __DIR__ . '/scripts/'
    ));

    $loader->registerNamespaces(array(
        'Phalcon' => __DIR__ . '/scripts/'
    ));

    $loader->register();

    if (Version::getId() < Script::COMPATIBLE_VERSION) {
        throw new PhalconException('Your Phalcon version isn\'t compatible with Developer Tools, download the latest at: http://phalconphp.com/download');
    }

    if (!defined('TEMPLATE_PATH')) {
        define('TEMPLATE_PATH', __DIR__ . '/templates');
    }

    $vendor = sprintf('Phalcon DevTools (%s)', Version::get());
    print PHP_EOL . Color::colorize($vendor, Color::FG_GREEN, Color::AT_BOLD) . PHP_EOL . PHP_EOL;

    $eventsManager = new EventsManager();

    $eventsManager->attach('command', new CommandsListener());

    $script = new Script($eventsManager);

    $commandsToEnable = array(
        '\Phalcon\Commands\Builtin\Enumerate',
        '\Phalcon\Commands\Builtin\Controller',
        '\Phalcon\Commands\Builtin\Model',
        '\Phalcon\Commands\Builtin\AllModels',
        '\Phalcon\Commands\Builtin\Project',
        '\Phalcon\Commands\Builtin\Scaffold',
        '\Phalcon\Commands\Builtin\Migration',
        '\Phalcon\Commands\Builtin\Webtools'
    );
    foreach ($commandsToEnable as $command) {
        $script->attach(new $command($script, $eventsManager));
    }

    $script->run();

} catch (PhalconException $e) {
    if ($extensionLoaded) {
        print Color::error($e->getMessage()) . PHP_EOL;
    } else {
        print 'ERROR: ' . $e->getMessage() . PHP_EOL;
    }

} catch (Exception $e) {
    if ($extensionLoaded) {
        print Color::error($e->getMessage()) . PHP_EOL;
    } else {
        print 'ERROR: ' . $e->getMessage() . PHP_EOL;
    }
}
