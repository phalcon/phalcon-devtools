<?php 

namespace Phalcon\DI\FactoryDefault {

	/**
	 * Phalcon\DI\FactoryDefault\CLI
	 *
	 * This is a variant of the standard Phalcon\DI. By default it automatically
	 * registers all the services provided by the framework.
	 * Thanks to this, the developer does not need to register each service individually.
	 * This class is specially suitable for CLI applications
	 */
	
	class CLI extends \Phalcon\DI\FactoryDefault {

		protected $_services;

		protected $_sharedInstances;

		protected $_freshInstance;

		protected static $_default;

		/**
		 * \Phalcon\DI\FactoryDefault\CLI constructor
		 */
		public function __construct(){ }

	}
}
