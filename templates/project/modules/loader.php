<?php

use Phalcon\Autoload\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->setNamespaces([
    '@@namespace@@\Models' => APP_PATH . '/common/models/',
    '@@namespace@@'        => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->setClasses([
    '@@namespace@@\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    '@@namespace@@\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
