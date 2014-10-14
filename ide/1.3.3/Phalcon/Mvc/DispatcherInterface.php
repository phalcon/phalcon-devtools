<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\DispatcherInterface initializer
	 */
	
	interface DispatcherInterface extends \Phalcon\DispatcherInterface {

		/**
		 * Sets the default controller suffix
		 *
		 * @param string $controllerSuffix
		 */
		public function setControllerSuffix($controllerSuffix);


		/**
		 * Sets the default controller name
		 *
		 * @param string $controllerName
		 */
		public function setDefaultController($controllerName);


		/**
		 * Sets the controller name to be dispatched
		 *
		 * @param string $controllerName
		 * @param bool $isExact If true, the name should not be mangled in any way
		 */
		public function setControllerName($controllerName, $isExact=null);


		/**
		 * Gets last dispatched controller name
		 *
		 * @return string
		 */
		public function getControllerName();


		/**
		 * Returns the lastest dispatched controller
		 *
		 * @return \Phalcon\Mvc\ControllerInterface
		 */
		public function getLastController();


		/**
		 * Returns the active controller in the dispatcher
		 *
		 * @return \Phalcon\Mvc\ControllerInterface
		 */
		public function getActiveController();

	}
}
