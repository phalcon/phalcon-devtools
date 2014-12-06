<?php 

namespace Phalcon\Di {

	/**
	 * Phalcon\Di\Injectable
	 *
	 * This class allows to access services in the services container by just only accessing a public property
	 * with the same name of a registered service
	 */
	
	abstract class Injectable implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_dependencyInjector;

		protected $_eventsManager;

		/**
		 * Sets the dependency injector
		 *
		 * @param \Phalcon\DiInterface dependencyInjector
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Sets the event manager
		 *
		 * @param \Phalcon\Events\ManagerInterface eventsManager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\ManagerInterface
		 */
		public function getEventsManager(){ }


		/**
		 * Magic method __get
		 *
		 * @param string propertyName
		 */
		public function __get($propertyName){ }

	}
}
