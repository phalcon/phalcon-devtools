<?php
/**
 * Local variables
 * @var \Phalcon\Config $config
 */

$di->set('config', function () use ($config) {
    return $config;
});
