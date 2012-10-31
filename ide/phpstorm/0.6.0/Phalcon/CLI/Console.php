<?php 

namespace Phalcon\CLI {

	/**
	 * Phalcon\CLI\Console
	 *
	 * This component allows to create CLI applications using Phalcon
	 */
	
	class Console {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_modules;

		protected $_moduleObject;

		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Sets the events manager
		 *
		 * @param \Phalcon\Events\Manager $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\Manager
		 */
		public function getEventsManager(){ }


		/**
		 * Register an array of modules present in the console
		 *
		 *<code>
		 *	$this->registerModules(array(
		 *		'frontend' => array(
		 *			'className' => 'Multiple\Frontend\Module',
		 *			'path' => '../apps/frontend/Module.php'
		 *		),
		 *		'backend' => array(
		 *			'className' => 'Multiple\Backend\Module',
		 *			'path' => '../apps/backend/Module.php'
		 *		)
		 *	));
		 *</code>
		 *
		 * @param array $modules
		 */
		public function registerModules($modules){ }


		/**
		 * Merge modules with the existing ones
		 *
		 * @param array $modules
		 */
		public function addModules($modules){ }


		/**
		 * Return the modules registered in the console
		 *
		 * @return array
		 */
		public function getModules(){ }


		/**
		 * Handle the whole command-line tasks
		 *
		 * @param array $arguments
		 * @return mixed
		 */
		public function handle($arguments=null){ }

	}
}
