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
		 * @param string $alias
		 * @param mixed $config
		 * @return \Phalcon\DI
		 */
		public function set($alias, $config){ }


		/**
		 * Removes a service in the services container
		 *
		 * @param string $alias
		 * @param mixed $config
		 * @return \Phalcon\DI
		 */
		public function remove($alias){ }


		/**
		 * Attempts to register a service in the services container
		 * Only is successful if a services hasn't been registered previosly
		 * with the same name
		 *
		 * @param string $alias
		 * @param mixed $config
		 * @return \Phalcon\DI
		 */
		public function attempt($alias, $config){ }


		/**
		 * Factories instances based on its config
		 *
		 * @param string $service
		 * @param mixed $parameters
		 * @return mixed
		 */
		public function _factory($service, $parameters){ }


		/**
		 * Resolves the service based on its configuration
		 *
		 * @param string $alias
		 * @param array $parameters
		 * @return mixed
		 */
		public function get($alias, $parameters=null){ }


		/**
		 * Returns a shared service based on its configuration
		 *
		 * @param string $alias
		 * @param array $parameters
		 * @return mixed
		 */
		public function getShared($alias, $parameters=null){ }


		/**
		 * Check whether the DI contains a service by a name
		 *
		 * @return boolean
		 */
		public function has($alias){ }


		/**
		 * Check whether the last service obtained via getShared produced a fresh instance or an existing one
		 *
		 * @return boolean
		 */
		public function wasFreshInstance(){ }


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
		 * @param string $dependencyInjector
		 */
		public static function setDefault($dependencyInjector){ }


		/**
		 * Return the last DI created
		 *
		 * @return \Phalcon\DI
		 */
		public static function getDefault(){ }


		/**
		 * Resets the internal default DI
		 */
		public static function reset(){ }

	}
}
