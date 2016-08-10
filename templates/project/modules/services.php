<?php

use Phalcon\Loader;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return @@configLoader@@;
});

/**
 * Shared configuration service
 */
$di->setShared('loader', function () {
    $config = $this->getConfig();

    /**
     * Include Autoloader
     */
    include APP_PATH . '/config/loader.php';

    return $loader;
});

/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () {
    $config = $this->getConfig();

    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);

    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});
