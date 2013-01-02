<?php 

namespace Phalcon {

	/**
	 * Phalcon\Config
	 *
	 * Phalcon\Config is designed to simplify the access to, and the use of, configuration data within applications.
	 * It provides a nested object property based user interface for accessing this configuration data within
	 * application code.
	 *
	 * <code>$config = new Phalcon\Config(array(
	 *  "database" => array(
	 *    "adapter" => "Mysql",
	 *    "host" => "localhost",
	 *    "username" => "scott",
	 *    "password" => "cheetah",
	 *    "name" => "test_db"
	 *  ),
	 *  "phalcon" => array(
	 *    "controllersDir" => "../app/controllers/",
	 *    "modelsDir" => "../app/models/",
	 *    "viewsDir" => "../app/views/"
	 *  )
	 * ));</code>
	 *
	 */
	
	class Config {

		/**
		 * \Phalcon\Config constructor
		 *
		 * @param array $arrayConfig
		 */
		public function __construct($arrayConfig=null){ }


		/**
		 * Restores the state of a \Phalcon\Config object
		 *
		 * @return \Phalcon\Config
		 */
		public static function __set_state($data){ }

	}
}
