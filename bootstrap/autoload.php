<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (http://www.phalconphp.com)       |
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

use Phalcon\Loader;
use Phalcon\Script;
use Phalcon\Version;

if (!extension_loaded('phalcon')) {
    throw new Exception(
        "Phalcon extension isn't installed, follow these instructions to install it: " .
        'https://docs.phalconphp.com/en/latest/reference/install.html'
    );
}

/**
 * @const DEVTOOLS_START_TIME The start time of the Devtools. Used for profiling.
 */
defined('DEVTOOLS_START_TIME') || define('DEVTOOLS_START_TIME', microtime(true));

/**
 * @const DEVTOOLS_START_MEMORY The memory usage at the start of the application. Used for profiling.
 */
defined('DEVTOOLS_START_TIME') || define('DEVTOOLS_START_MEMORY', memory_get_usage());

/**
 * @const DEVTOOLS_ROOT Current Devtools root path.
 */
defined('DEVTOOLS_ROOT') || define('DEVTOOLS_ROOT', dirname(dirname(__FILE__)));

/**
 * @const TEMPLATE_PATH Devtools templates path.
 */
defined('TEMPLATE_PATH') || define('TEMPLATE_PATH', DEVTOOLS_ROOT . '/templates');

/**
 * Register Devtools classes.
 */
(new Loader)->registerDirs([DEVTOOLS_ROOT . '/scripts/'])
    ->registerNamespaces(['Phalcon' => DEVTOOLS_ROOT . '/scripts/'])
    ->register();

/**
 * Register the Composer autoloader (if any)
 */
if (file_exists(DEVTOOLS_ROOT . '/vendor/autoload.php')) {
    require_once DEVTOOLS_ROOT . '/vendor/autoload.php';
}

/**
 * Register the custom loader (if any)
 */
if (file_exists(DEVTOOLS_ROOT . '/.phalcon/autoload.php')) {
    require_once DEVTOOLS_ROOT . '/.phalcon/autoload.php';
}

if (Version::getId() < Script::COMPATIBLE_VERSION) {
    throw new Exception(
        sprintf(
            "Your Phalcon version isn't compatible with Developer Tools, download the latest at: %s",
            Script::DOC_DOWNLOAD_URL
        )
    );
}
