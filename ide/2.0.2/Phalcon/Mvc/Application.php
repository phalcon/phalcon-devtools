<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Application
	 *
	 * This component encapsulates all the complex operations behind instantiating every component
	 * needed and integrating it with the rest to allow the MVC pattern to operate as desired.
	 *
	 *<code>
	 *
	 * class Application extends \Phalcon\Mvc\Application
	 * {
	 *
	 *		/**
	 *		 * Register the services here to make them general or register
	 *		 * in the ModuleDefinition to make them module-specific
	 *		 *\/
	 *		protected function _registerServices()
	 *		{
	 *
	 *		}
	 *
	 *		/**
	 *		 * This method registers all the modules in the application
	 *		 *\/
	 *		public function main()
	 *		{
	 *			$this->registerModules(array(
	 *				'frontend' => array(
	 *					'className' => 'Multiple\Frontend\Module',
	 *					'path' => '../apps/frontend/Module.php'
	 *				),
	 *				'backend' => array(
	 *					'className' => 'Multiple\Backend\Module',
	 *					'path' => '../apps/backend/Module.php'
	 *				)
	 *			));
	 *		}
	 *	}
	 *
	 *	$application = new Application();
	 *	$application->main();
	 *
	 *</code>
	 */
	
	class Application extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Di\InjectionAwareInterface {

		protected $_defaultModule;

		protected $_modules;

		protected $_implicitView;

		/**
		 * \Phalcon\Mvc\Application
		 */
		public function __construct(\Phalcon\DiInterface $dependencyInjector=null){ }


		/**
		 * By default. The view is implicitly buffering all the output
		 * You can full disable the view component using this method
		 */
		public function useImplicitView($implicitView){ }


		/**
		 * Register an array of modules present in the application
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
		 */
		public function registerModules($modules, $merge=null){ }


		/**
		 * Return the modules registered in the application
		 *
		 * @return array
		 */
		public function getModules(){ }


		/**
		 * Gets the module definition registered in the application via module name
		 *
		 * @param string name
		 * @return array|object
		 */
		public function getModule($name){ }


		/**
		 * Sets the module name to be used if the router doesn't return a valid module
		 */
		public function setDefaultModule($defaultModule){ }


		/**
		 * Returns the default module name
		 */
		public function getDefaultModule(){ }


		/**
		 * Handles a MVC request
		 *
		 * @param string uri
		 * @return \Phalcon\Http\ResponseInterface|boolean
		 */
		public function handle($uri=null){ }

	}
}
