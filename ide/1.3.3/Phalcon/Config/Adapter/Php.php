<?php 

namespace Phalcon\Config\Adapter {

	/**
	 * Phalcon\Config\Adapter\Php
	 *
	 * Reads php files and converts them to Phalcon\Config objects.
	 *
	 * Given the next configuration file:
	 *
	 *<code>
	 *<?php
	 *return array(
	 *	'database' => array(
	 *		'adapter' => 'Mysql',
	 *		'host' => 'localhost',
	 *		'username' => 'scott',
	 *		'password' => 'cheetah',
	 *		'dbname' => 'test_db'
	 *	),
	 *
	 *	'phalcon' => array(
	 *		'controllersDir' => '../app/controllers/',
	 *		'modelsDir' => '../app/models/',
	 *		'viewsDir' => '../app/views/'
	 *));
	 *</code>
	 *
	 * You can read it as follows:
	 *
	 *<code>
	 *	$config = new Phalcon\Config\Adapter\Php("path/config.php");
	 *	echo $config->phalcon->controllersDir;
	 *	echo $config->database->username;
	 *</code>
	 *
	 */
	
	class Php extends \Phalcon\Config implements \Countable, \ArrayAccess {

		/**
		 * \Phalcon\Config\Adapter\Php constructor
		 *
		 * @param string $filePath
		 */
		public function __construct($filePath){ }

	}
}
