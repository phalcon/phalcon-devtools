<?php

use Phalcon\Mvc\View\Simple as View;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;

$di = new FactoryDefault();

/**
 * Sets the view component
 */
$di['view'] = function () use ($config) {
    $view = new View();
    $view->setViewsDir($config->application->viewsDir);
    return $view;
};

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di['url'] = function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
};

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di['db'] = function () use ($config) {
    $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->adapter;
    return new $dbClass($config->database->toArray());
};
