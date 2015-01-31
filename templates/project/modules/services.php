<?php

/**
 * Services are globally registered in this file
 */

use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\DI\FactoryDefault;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * The FactoryDefault Dependency Injector automatically registers the right services to provide a full stack framework
 */
$di = new FactoryDefault();

/**
 * Registering a router
 */
$di['router'] = function () {

    $router = new Router();

    $router->setDefaultModule('frontend');
    $router->setDefaultNamespace('@@namespace@@\Frontend\Controllers');

    return $router;
};

/**
 * The URL component is used to generate all kinds of URLs in the application
 */
$di['url'] = function () {
    $url = new UrlResolver();
    $url->setBaseUri('/@@name@@/');

    return $url;
};

/**
 * Starts the session the first time some component requests the session service
 */
$di['session'] = function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
};
