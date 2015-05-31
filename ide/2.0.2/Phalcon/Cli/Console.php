<?php 

namespace Phalcon\Cli {

	/**
	 * Phalcon\Cli\Console
	 *
	 * This component allows to create CLI applications using Phalcon
	 */
	
	class Console implements \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface {

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_modules;

		protected $_moduleObject;

		protected $_arguments;

		protected $_options;

		/**
		 * \Phalcon\Cli\Console constructor
		 */
		public function __construct(\Phalcon\DiInterface $dependencyInjector=null){ }


		/**
		 * Sets the DependencyInjector container
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the internal dependency injector
		 */
		public function getDI(){ }


		/**
		 * Sets the events manager
		 */
		public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager){ }


		/**
		 * Returns the internal event manager
		 */
		public function getEventsManager(){ }


		/**
		 * Register an array of modules present in the console
		 *
		 *<code>
		 *	$application->registerModules(array(
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
		 */
		public function registerModules($modules){ }


		/**
		 * Merge modules with the existing ones
		 *
		 *<code>
		 *	application->addModules(array(
		 *		'admin' => array(
		 *			'className' => 'Multiple\Admin\Module',
		 *			'path' => '../apps/admin/Module.php'
		 *		)
		 *	));
		 *</code>
		 */
		public function addModules($modules){ }


		/**
		 * Return the modules registered in the console
		 */
		public function getModules(){ }


		/**
		 * Handle the whole command-line tasks
		 */
		public function handle($arguments=null){ }


		/**
		 * Set an specific argument
		 */
		public function setArgument($arguments=null, $str=null, $shift=null){ }

	}
}
