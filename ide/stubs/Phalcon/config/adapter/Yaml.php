<?php

namespace Phalcon\Config\Adapter;

/**
 * Phalcon\Config\Adapter\Yaml
 * Reads YAML files and converts them to Phalcon\Config objects.
 * Given the following configuration file:
 * <code>
 * phalcon:
 * baseuri:        /phalcon/
 * controllersDir: !approot  /app/controllers/
 * models:
 * metadata: memory
 * </code>
 * You can read it as follows:
 * <code>
 * define('APPROOT', dirname(__DIR__));
 * $config = new Phalcon\Config\Adapter\Yaml("path/config.yaml", [
 * '!approot' => function($value) {
 * return APPROOT . $value;
 * }
 * ]);
 * echo $config->phalcon->controllersDir;
 * echo $config->phalcon->baseuri;
 * echo $config->models->metadata;
 * </code>
 */
class Yaml extends \Phalcon\Config
{

    /**
     * Phalcon\Config\Adapter\Yaml constructor
     *
     * @throws \Phalcon\Config\Exception
     * @param string $filePath 
     * @param array $callbacks 
     */
    public function __construct($filePath, array $callbacks = null) {}

}
