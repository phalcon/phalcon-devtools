<?php
/**
 * Local variables
 *
 * @var \Phalcon\Config $config
 * @var \Phalcon\Di\FactoryDefault\Cli $di
 */

$di->setShared('config', function () use ($config) {
    return $config;
});
