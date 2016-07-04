<?php

namespace Phalcon;

/**
 * Phalcon\Config
 * Phalcon\Config is designed to simplify the access to, and the use of, configuration data within applications.
 * It provides a nested object property based user interface for accessing this configuration data within
 * application code.
 * <code>
 * $config = new \Phalcon\Config(array(
 * "database" => array(
 * "adapter" => "Mysql",
 * "host" => "localhost",
 * "username" => "scott",
 * "password" => "cheetah",
 * "dbname" => "test_db"
 * ),
 * "phalcon" => array(
 * "controllersDir" => "../app/controllers/",
 * "modelsDir" => "../app/models/",
 * "viewsDir" => "../app/views/"
 * )
 * ));
 * </code>
 */
class Config implements \ArrayAccess, \Countable
{

    /**
     * Phalcon\Config constructor
     *
     * @param array $arrayConfig 
     */
    public function __construct(array $arrayConfig = null) {}

    /**
     * Allows to check whether an attribute is defined using the array-syntax
     * <code>
     * var_dump(isset($config['database']));
     * </code>
     *
     * @param mixed $index 
     * @return bool 
     */
    public function offsetExists($index) {}

    /**
     * Gets an attribute from the configuration, if the attribute isn't defined returns null
     * If the value is exactly null or is not defined the default value will be used instead
     * <code>
     * echo $config->get('controllersDir', '../app/controllers/');
     * </code>
     *
     * @param mixed $index 
     * @param mixed $defaultValue 
     * @return mixed 
     */
    public function get($index, $defaultValue = null) {}

    /**
     * Gets an attribute using the array-syntax
     * <code>
     * print_r($config['database']);
     * </code>
     *
     * @param mixed $index 
     * @return string 
     */
    public function offsetGet($index) {}

    /**
     * Sets an attribute using the array-syntax
     * <code>
     * $config['database'] = array('type' => 'Sqlite');
     * </code>
     *
     * @param mixed $index 
     * @param mixed $value 
     */
    public function offsetSet($index, $value) {}

    /**
     * Unsets an attribute using the array-syntax
     * <code>
     * unset($config['database']);
     * </code>
     *
     * @param mixed $index 
     */
    public function offsetUnset($index) {}

    /**
     * Merges a configuration into the current one
     * <code>
     * $appConfig = new \Phalcon\Config(array('database' => array('host' => 'localhost')));
     * $globalConfig->merge($config2);
     * </code>
     *
     * @param mixed $config 
     * @return Config 
     */
    public function merge(Config $config) {}

    /**
     * Converts recursively the object to an array
     * <code>
     * print_r($config->toArray());
     * </code>
     *
     * @return array 
     */
    public function toArray() {}

    /**
     * Returns the count of properties set in the config
     * <code>
     * print count($config);
     * </code>
     * or
     * <code>
     * print $config->count();
     * </code>
     *
     * @return int 
     */
    public function count() {}

    /**
     * Restores the state of a Phalcon\Config object
     *
     * @param array $data 
     * @return Config 
     */
    public static function __set_state(array $data) {}

    /**
     * Helper method for merge configs (forwarding nested config instance)
     *
     * @param Config $config 
     * @param Config $instance = null
     * @return Config config
     */
    protected final function _merge(Config $config, $instance = null) {}

}
