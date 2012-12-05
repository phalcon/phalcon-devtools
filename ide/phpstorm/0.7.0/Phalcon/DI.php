<?php 

namespace Phalcon {

	/**
	 * Phalcon\DI
	 *
	 * Phalcon\DI is a component that implements Dependency Injection of services and
	 * it's itself a container for them.
	 *
	 * Since Phalcon is highly decoupled, Phalcon\DI is essential to integrate the different
	 * components of the framework. The developer can also use this component to inject dependencies
	 * and manage global instances of the different classes used in the application.
	 *
	 * Basically, this component implements the `Inversion of Control` pattern. Applying this,
	 * the objects do not receive their dependencies using setters or constructors, but requesting
	 * a service dependency injector. This reduces the overall complexity, since there is only one
	 * way to get the required dependencies within a component.
	 *
	 * Additionally, this pattern increases testability in the code, thus making it less prone to errors.
	 */
	
	class DI {

		protected $_services;

		protected $_sharedInstances;

		protected $_freshInstance;

		protected static $_default;

		/**
		 * \Phalcon\DI constructor
		 *
		 */
		public function __construct(){ }


		/**
		 * Registers a service in the services container
		 *
		 * @param string $name
		 * @param mixed $config
		 * @param boolean $shared
		 * @return \Phalcon\Di\ServiceInterface
		 */
		public function set($name, $config, $shared=null){ }


		/**
		 * Registers an "always shared" service in the services container
		 *
		 * @param string $name
		 * @param mixed $config
		 * @return \Phalcon\Di\ServiceInterface
		 */
		public function setShared($name, $config){ }


		/**
		 * Removes a service in the services container
		 *
		 * @param string $name
		 */
		public function remove($name){ }


		/**
		 * Attempts to register a service in the services container
		 * Only is successful if a service hasn't been registered previously
		 * with the same name
		 *
		 * @param string $name
		 * @param mixed $config
		 * @return \Phalcon\Di\ServiceInterface
		 */
		public function attempt($name, $config, $shared=null){ }


		/**
		 * Returns a service definition without resolving
		 *
		 * @param string $name
		 * @return mixed
		 */
		public function getRaw($name){ }


		/**
		 * Returns a \Phalcon\Di\Service instance
		 *
		 * @return \Phalcon\Di\ServiceInterface
		 */
		public function getService($name){ }


		/**
		 * Resolves the service based on its configuration
		 *
		 * @param string $name
		 * @param array $parameters
		 * @return mixed
		 */
		public function get($name, $parameters=null){ }


		/**
		 * Returns a shared service based on their configuration
		 *
		 * @param string $name
		 * @param array $parameters
		 * @return mixed
		 */
		public function getShared($name, $parameters=null){ }


		/**
		 * Check whether the DI contains a service by a name
		 *
		 * @param string $name
		 * @return boolean
		 */
		public function has($name){ }


		/**
		 * Check whether the last service obtained via getShared produced a fresh instance or an existing one
		 *
		 * @return boolean
		 */
		public function wasFreshInstance(){ }


		/**
		 * Return the services registered in the DI
		 *
		 * @return array
		 */
		public function getServices(){ }


		/**
		 * Magic method to get or set services using setters/getters
		 *
		 * @param string $method
		 * @param array $arguments
		 * @return mixed
		 */
		public function __call($method, $arguments=null){ }


		/**
		 * Set a default dependency injection container to be obtained into static methods
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public static function setDefault($dependencyInjector){ }


		/**
		 * Return the lastest DI created
		 *
		 * @return \Phalcon\DiInterface
		 */
		public static function getDefault(){ }


		/**
		 * Resets the internal default DI
		 */
		public static function reset(){ }

	}
}
