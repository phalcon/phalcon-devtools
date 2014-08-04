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
		public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector)


		/**
		 * Registers services related to the module
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function registerServices(\Phalcon\DiInterface $dependencyInjector);

	}
}
