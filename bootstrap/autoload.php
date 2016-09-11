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
 * @const PTOOLSPATH The path to the Phalcon Developers Tools.
 */
defined('PTOOLSPATH') || define('PTOOLSPATH', rtrim(getenv('PTOOLSPATH') ?: dirname(dirname(__FILE__)), '\\/'));

/**
 * @const TEMPLATE_PATH Devtools templates path.
 */
defined('TEMPLATE_PATH') || define('TEMPLATE_PATH', PTOOLSPATH . '/templates');

/**
 * @const ENV_PRODUCTION Application production stage.
 */
defined('ENV_PRODUCTION') || define('ENV_PRODUCTION', 'production');

/**
 * @const ENV_STAGING Application staging stage.
 */
defined('ENV_STAGING') || define('ENV_STAGING', 'staging');

/**
 * @const ENV_DEVELOPMENT Application development stage.
 */
defined('ENV_DEVELOPMENT') || define('ENV_DEVELOPMENT', 'development');

/**
 * @const ENV_TESTING Application test stage.
 */
defined('ENV_TESTING') || define('ENV_TESTING', 'testing');

/**
 * @const APPLICATION_ENV Current application stage.
 */
defined('APPLICATION_ENV') || define('APPLICATION_ENV', getenv('APP_ENV') ?: ENV_PRODUCTION);

/**
 * @const DS The DIRECTORY_SEPARATOR shortcut.
 */
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

if (ENV_DEVELOPMENT === APPLICATION_ENV) {
    error_reporting(E_ALL);

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    ini_set('html_errors', 1);

    // Enable xdebug parameter collection in development mode to improve fatal stack traces.
    // Highly recommends use at least XDebug 2.2.3 for a better compatibility with Phalcon
    if (extension_loaded('xdebug')) {
        ini_set('xdebug.collect_params', 4);
    }
}

if (PHP_SAPI == 'cli') {
    set_time_limit(0);
}

/**
 * Register Devtools classes.
 */
(new Loader)->registerDirs([
        PTOOLSPATH . DS . 'scripts' . DS
    ])
    ->registerNamespaces([
        'Phalcon'              => PTOOLSPATH . DS . 'scripts' . DS,
        'WebTools\Controllers' => PTOOLSPATH . DS . str_replace('/', DS, 'scripts/Phalcon/Web/Tools/Controllers') . DS,
    ])
    ->register();

/**
 * Register the Composer autoloader (if any)
 */
if (file_exists(PTOOLSPATH . DS .'vendor' . DS . 'autoload.php')) {
    require_once PTOOLSPATH . DS .'vendor' . DS . 'autoload.php';
}

/**
 * Register the custom loader (if any)
 */
if (file_exists(PTOOLSPATH . DS . '.phalcon' . DS . 'autoload.php')) {
    require_once PTOOLSPATH . DS .  '.phalcon' . DS . 'autoload.php';
}

if (Version::getId() < Script::COMPATIBLE_VERSION) {
    throw new Exception(
        sprintf(
            "Your Phalcon version isn't compatible with Developer Tools, download the latest at: %s",
            Script::DOC_DOWNLOAD_URL
        )
    );
}
