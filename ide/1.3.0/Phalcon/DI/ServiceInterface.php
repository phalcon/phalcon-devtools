<?php 

namespace Phalcon\DI {

	/**
	 * Phalcon\DI\ServiceInterface initializer
	 */
	
	interface ServiceInterface {

		/**
		 * Returns the service's name
		 *
		 * @param string
		 */
		public function getName();


		/**
		 * Sets if the service is shared or not
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


		public function isResolved();


		/**
		 * Resolves the service
		 *
		 * @param array $parameters
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @return mixed
		 */
		public function resolve($parameters=null, $dependencyInjector=null);

	}
}
