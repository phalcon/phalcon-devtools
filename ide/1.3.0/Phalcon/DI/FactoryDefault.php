<?php 

namespace Phalcon\DI {

	/**
	 * Phalcon\DI\FactoryDefault
	 *
	 * This is a variant of the standard Phalcon\DI. By default it automatically
	 * registers all the services provided by the framework. Thanks to this, the developer does not need
	 * to register each service individually providing a full stack framework
	 */
	
	class FactoryDefault extends \Phalcon\DI implements \Phalcon\DiInterface {

		/**
		 * \Phalcon\DI\FactoryDefault constructor
		 */
		public function __construct(){ }

	}
}
