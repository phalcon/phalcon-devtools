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
     *		$router = new Annotations(false);
     *
     *		//This will do the same as above but only if the handled uri starts with /robots
     * 		$router->addResource('Robots', '/robots');
     *
     * 		return $router;
     *	};
     *</code>
     */
    class Annotations extends \Phalcon\Mvc\Router
    {

        const URI_SOURCE_GET_URL = 0;

        const URI_SOURCE_SERVER_REQUEST_URI = 1;

        protected $_handlers;

        protected $_processed;

        protected $_controllerSuffix;

        protected $_actionSuffix;

        protected $_routePrefix;

        /**
         * Adds a resource to the annotations handler
         * A resource is a class that contains routing annotations
         *
         * @param string handler
         * @param string prefix
         * @return \Phalcon\Mvc\Router\Annotations
         */
        public function addResource($handler, $prefix=null)
        {
        }


        /**
         * Adds a resource to the annotations handler
         * A resource is a class that contains routing annotations
         * The class is located in a module
         *
         * @param string module
         * @param string handler
         * @param string prefix
         * @return \Phalcon\Mvc\Router\Annotations
         */
        public function addModuleResource($module, $handler, $prefix=null)
        {
        }


        /**
         * Produce the routing parameters from the rewrite information
         *
         * @param string uri
         */
        public function handle($uri=null)
        {
        }


        /**
         * Checks for annotations in the controller docblock
         *
         * @param string handler
         * @param \Phalcon\Annotations\Annotation
         */
        public function processControllerAnnotation($handler, $annotation)
        {
        }


        /**
         * Checks for annotations in the public methods of the controller
         *
         * @param string module
         * @param string namespaceName
         * @param string controller
         * @param string action
         * @param \Phalcon\Annotations\Annotation annotation
         */
        public function processActionAnnotation($module, $namespaceName, $controller, $action, $annotation)
        {
        }


        /**
         * Changes the controller class suffix
         *
         * @param string controllerSuffix
         */
        public function setControllerSuffix($controllerSuffix)
        {
        }


        /**
         * Changes the action method suffix
         *
         * @param string actionSuffix
         */
        public function setActionSuffix($actionSuffix)
        {
        }


        /**
         * Return the registered resources
         *
         * @return array
         */
        public function getResources()
        {
        }

    }
}
