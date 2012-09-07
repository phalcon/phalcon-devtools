<?php 

namespace Phalcon\DI {

	/**
	 * Phalcon\DI\FactoryDefault
	 *
	 * This is a variant of the standard Phalcon\DI. By default it automatically
	 * registers all the services provided by the framework. Thanks to this, the developer does not need
	 * to register each service individually.
	 */
	
	class FactoryDefault extends \Phalcon\DI {

		protected $_services;

		protected $_sharedInstances;

		protected $_freshInstance;

		protected static $_default;

		/**
		 * \Phalcon\DI\FactoryDefault constructor
		 */
		public function __construct(){ }

	}
}
