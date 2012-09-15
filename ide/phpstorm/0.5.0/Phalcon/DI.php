<?php 

namespace Phalcon {

	/**
	 * Phalcon\DI
	 *
	 */
	
	class DI {

		protected $_services;

		protected $_sharedInstances;

		protected $_freshInstance;

		protected static $_default;

		public function __construct(){ }


		public function set($alias, $config){ }


		public function remove($alias){ }


		public function attempt($alias, $config){ }


		public function _factory($service, $parameters){ }


		public function get($alias, $parameters){ }


		public function getShared($alias, $parameters){ }


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
		public function __call($method, $arguments){ }


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
