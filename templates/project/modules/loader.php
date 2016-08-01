<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    '@@namespace@@\Models' => APP_PATH . '/common/models/',
    '@@namespace@@' => APP_PATH . '/common/library/'
]);

$loader->register();
