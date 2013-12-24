<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\ModuleDefinitionInterface initializer
	 */
	
	interface ModuleDefinitionInterface {

		/**
		 * Registers an autoloader related to the module
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function registerAutoloaders();


		/**
		 * Registers services related to the module
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function registerServices($dependencyInjector);

	}
}
