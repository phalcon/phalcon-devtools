<?php 

namespace Phalcon\DI {

	/**
	 * Phalcon\DI\ServiceInterface initializer
	 */
	
	interface ServiceInterface {

		/**
		 * Returns the name of the service
		 *
		 * @return string
		 */
		public function getName();


		/**
		 * Sets whether the service is shared or not
		 *
		 * @param boolean $shared
		 */
		public function setShared($shared);


		/**
		 * Check whether the service is shared or not
		 *
		 * @return boolean
		 */
		public function isShared();


		/**
		 * Set the service definition
		 *
		 * @param mixed $definition
		 */
		public function setDefinition($definition);


		/**
		 * Returns the service definition
		 *
		 * @return mixed
		 */
		public function getDefinition();


		/**
		 * Checks if the service was resolved
		 *
		 * @return bool
		 */
		public function isResolved();


		/**
		 * Resolves the service
		 *
		 * @param array $parameters
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @return object
		 */
		public function resolve($parameters=null, $dependencyInjector=null);

	}
}
