<?php 

namespace Phalcon {

	/**
	 * Phalcon\DiInterface initializer
	 */
	
	interface DiInterface extends \ArrayAccess {

		/**
		 * Registers a service in the services container
		 *
		 * @param string $alias
		 * @param mixed $definition
		 * @param boolean $shared
		 * @return \Phalcon\DI\ServiceInterface
		 */
		public function set($alias, $definition, $shared=null);


		/**
		 * Registers an "always shared" service in the services container
		 *
		 * @param string $name
		 * @param mixed $definition
		 * @return \Phalcon\DI\ServiceInterface
		 */
		public function setShared($name, $definition);


		/**
		 * Removes a service in the services container
		 *
		 * @param string $alias
		 */
		public function remove($alias);


		/**
		 * Attempts to register a service in the services container
		 * Only is successful if a service hasn't been registered previously
		 * with the same name
		 *
		 * @param string $alias
		 * @param mixed $definition
		 * @param boolean $shared
		 * @return \Phalcon\DI\ServiceInterface
		 */
		public function attempt($alias, $definition, $shared=null);


		/**
		 * Resolves the service based on its configuration
		 *
		 * @param string $alias
		 * @param array $parameters
		 * @return mixed
		 */
		public function get($alias, $parameters=null);


		/**
		 * Returns a shared service based on their configuration
		 *
		 * @param string $alias
		 * @param array $parameters
		 * @return mixed
		 */
		public function getShared($alias, $parameters=null);


		/**
		 * Sets a service using a raw \Phalcon\DI\Service definition
		 *
		 * @param string $name
		 * @param \Phalcon\DI\ServiceInterface $rawDefinition
		 * @return \Phalcon\DI\ServiceInterface
		 */
		public function setRaw($name, $rawDefinition);


		/**
		 * Returns a service definition without resolving
		 *
		 * @param string $name
		 * @return mixed
		 */
		public function getRaw($name);


		/**
		 * Returns the corresponding \Phalcon\Di\Service instance for a service
		 *
		 * @param string $name
		 * @return \Phalcon\DI\ServiceInterface
		 */
		public function getService($name);


		/**
		 * Check whether the DI contains a service by a name
		 *
		 * @param string $alias
		 * @return boolean
		 */
		public function has($alias);


		/**
		 * Check whether the last service obtained via getShared produced a fresh instance or an existing one
		 *
		 * @return boolean
		 */
		public function wasFreshInstance();


		/**
		 * Return the services registered in the DI
		 *
		 * @return array
		 */
		public function getServices();


		/**
		 * Set a default dependency injection container to be obtained into static methods
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public static function setDefault($dependencyInjector);


		/**
		 * Return the last DI created
		 *
		 * @return \Phalcon\DiInterface
		 */
		public static function getDefault();


		/**
		 * Resets the internal default DI
		 */
		public static function reset();

	}
}
