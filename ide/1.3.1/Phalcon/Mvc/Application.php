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
	 *		/\**
	 *		 * Register the services here to make them general or register
	 *		 * in the ModuleDefinition to make them module-specific
	 *		 *\/
	 *		protected function _registerServices()
	 *		{
	 *
	 *		}
	 *
	 *		/\**
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
	
	class Application extends \Phalcon\DI\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface {

		protected $_defaultModule;

		protected $_modules;

		protected $_moduleObject;

		protected $_implicitView;

		/**
		 * \Phalcon\Mvc\Application
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function __construct($dependencyInjector=null){ }


		/**
		 * By default. The view is implicitly buffering all the output
		 * You can full disable the view component using this method
		 *
		 * @param boolean $implicitView
		 * @return \Phalcon\Mvc\Application
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
		 *
		 * @param array $modules
		 * @param boolean $merge
		 * @param \Phalcon\Mvc\Application
		 */
		public function registerModules($modules, $merge=null){ }


		/**
		 * Return the modules registered in the application
		 *
		 * @return array
		 */
		public function getModules(){ }


		/**
		 * Sets the module name to be used if the router doesn't return a valid module
		 *
		 * @param string $defaultModule
		 * @return \Phalcon\Mvc\Application
		 */
		public function setDefaultModule($defaultModule){ }


		/**
		 * Returns the default module name
		 *
		 * @return string
		 */
		public function getDefaultModule(){ }


		/**
		 * Handles a MVC request
		 *
		 * @param string $uri
		 * @return \Phalcon\Http\ResponseInterface
		 */
		public function handle($uri=null){ }

	}
}
