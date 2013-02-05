<?php 

namespace Phalcon\Mvc\Router {

	/**
	 * Phalcon\Mvc\Router\Annotations
	 *
	 * A router that reads routes annotations from classes/resources
	 *
	 *<code>
	 * $di['router'] = function() {
	 *
	 *		//Use the annotations router
	 *		$router = new \Phalcon\Mvc\Router\Annotations();
	 *
	 *		//This will do the same as above but only if the handled uri starts with /robots
	 * 		$router->addResource('Robots', '/robots');
	 *
	 * 		return $router;
	 *	};
	 *</code>
	 */
	
	class Annotations extends \Phalcon\Mvc\Router {

		protected $_handlers;

		protected $_processed;

		protected $_controllerSufix;

		protected $_actionSufix;

		protected $_routePrefix;

		/**
		 * Adds a resource to the annotations handler
		 * A resource is a class that contains routing annotations
		 *
		 * @param string $handler
		 * @param string $prefix
		 * @return \Phalcon\Mvc\Router\Annotations
		 */
		public function addResource($handler, $prefix=null){ }


		/**
		 * Produce the routing parameters from the rewrite information
		 *
		 * @param string $uri
		 */
		public function handle($uri=null){ }


		/**
		 * Checks for annotations in the controller docblock
		 *
		 * @param string $handler
		 * @param \Phalcon\Annotations\AdapterInterface
		 */
		public function processControllerAnnotation($handler, $annotation){ }


		/**
		 * Checks for annotations in the public methods of the controller
		 *
		 * @param string $controller
		 * @param string $action
		 * @param \Phalcon\Annotations\Annotation $annotation
		 */
		public function processActionAnnotation($controller, $action, $annotation){ }

	}
}
