<?php 

namespace Phalcon\DI {

	/**
	 * Phalcon\DI\ServiceInterface initializer
	 */
	
	interface ServiceInterface {

		/**
		 * \Phalcon\DI\ServiceInterface
		 *
		 * @param string $name
		 * @param mixed $definition
		 * @param boolean $shared
		 */
		public function __construct($name, $definition, $shared=null);


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


		/**
		 * Resolves the service
		 *
		 * @param array $parameters
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @return mixed
		 */
		public function resolve($parameters=null, $dependencyInjector=null);


		/**
		 * Restore the interal state of a service
		 *
		 * @param array $attributes
		 * @return \Phalcon\DI\ServiceInterface
		 */
		public static function __set_state($attributes);

	}
}
