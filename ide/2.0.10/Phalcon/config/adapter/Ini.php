<?php

namespace Phalcon\Config\Adapter;

/**
 * Phalcon\Config\Adapter\Ini
 * Reads ini files and converts them to Phalcon\Config objects.
 * Given the next configuration file:
 * <code>
 * [database]
 * adapter = Mysql
 * host = localhost
 * username = scott
 * password = cheetah
 * dbname = test_db
 * [phalcon]
 * controllersDir = "../app/controllers/"
 * modelsDir = "../app/models/"
 * viewsDir = "../app/views/"
 * </code>
 * You can read it as follows:
 * <code>
 * $config = new Phalcon\Config\Adapter\Ini("path/config.ini");
 * echo $config->phalcon->controllersDir;
 * echo $config->database->username;
 * </code>
 */
class Ini extends \Phalcon\Config
{

    /**
     * Phalcon\Config\Adapter\Ini constructor
     *
     * @param string $filePath 
     */
    public function __construct($filePath) {}

    /**
     * Build multidimensional array from string
     * <code>
     * $this->_parseIniString('path.hello.world', 'value for last key');
     * // result
     * [
     * 'path' => [
     * 'hello' => [
     * 'world' => 'value for last key',
     * ],
     * ],
     * ];
     * </code>
     *
     * @param string $path 
     * @param mixed $value 
     * @return array 
     */
    protected function _parseIniString($path, $value) {}

}
