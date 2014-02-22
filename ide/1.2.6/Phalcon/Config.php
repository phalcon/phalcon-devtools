<?php 

namespace Phalcon {

	/**
	 * Phalcon\Config
	 *
	 * Phalcon\Config is designed to simplify the access to, and the use of, configuration data within applications.
	 * It provides a nested object property based user interface for accessing this configuration data within
	 * application code.
	 *
	 *<code>
	 *	$config = new Phalcon\Config(array(
	 *		"database" => array(
	 *			"adapter" => "Mysql",
	 *			"host" => "localhost",
	 *			"username" => "scott",
	 *			"password" => "cheetah",
	 *			"dbname" => "test_db"
	 *		),
	 *		"phalcon" => array(
	 *			"controllersDir" => "../app/controllers/",
	 *			"modelsDir" => "../app/models/",
	 *			"viewsDir" => "../app/views/"
	 *		)
	 * ));
	 *</code>
	 *
	 */
	
	class Config implements \ArrayAccess, \Countable {

		/**
		 * \Phalcon\Config constructor
		 *
		 * @param array $arrayConfig
		 */
		public function __construct($arrayConfig=null){ }


		/**
		 * Allows to check whether an attribute is defined using the array-syntax
		 *
		 *<code>
		 * var_dump(isset($config['database']));
		 *</code>
		 *
		 * @param string $index
		 * @return boolean
		 */
		public function offsetExists($index){ }


		/**
		 * Gets an attribute from the configuration, if the attribute isn't defined returns null
		 * If the value is exactly null or is not defined the default value will be used instead
		 *
		 *<code>
		 * echo $config->get('controllersDir', '../app/controllers/');
		 *</code>
		 *
		 * @param string $index
		 * @param mixed $defaultValue
		 * @return mixed
		 */
		public function get($index, $defaultValue=null){ }


		/**
		 * Gets an attribute using the array-syntax
		 *
		 *<code>
		 * print_r($config['database']);
		 *</code>
		 *
		 * @param string $index
		 * @return string
		 */
		public function offsetGet($index){ }


		/**
		 * Sets an attribute using the array-syntax
		 *
		 *<code>
		 * $config['database'] = array('type' => 'Sqlite');
		 *</code>
		 *
		 * @param string $index
		 * @param mixed $value
		 */
		public function offsetSet($index, $value){ }


		/**
		 * Unsets an attribute using the array-syntax
		 *
		 *<code>
		 * unset($config['database']);
		 *</code>
		 *
		 * @param string $index
		 */
		public function offsetUnset($index){ }


		/**
		 * Merges a configuration into the current one
		 *
		 * @brief void \Phalcon\Config::merge(array|object $with)
		 *
		 *<code>
		 *	$appConfig = new \Phalcon\Config(array('database' => array('host' => 'localhost')));
		 *	$globalConfig->merge($config2);
		 *</code>
		 *
		 * @param \Phalcon\Config $config
		 */
		public function merge($config){ }


		/**
		 * Converts recursively the object to an array
		 *
		 * @brief array \Phalcon\Config::toArray(bool $recursive = true);
		 *
		 *<code>
		 *	print_r($config->toArray());
		 *</code>
		 *
		 * @return array
		 */
		public function toArray(){ }


		public function count(){ }


		public function __wakeup(){ }


		/**
		 * Restores the state of a \Phalcon\Config object
		 *
		 * @param array $data
		 * @return \Phalcon\Config
		 */
		public static function __set_state($data){ }


		public function __get($index){ }


		public function __set($index, $value){ }


		public function __isset($index){ }

	}
}
