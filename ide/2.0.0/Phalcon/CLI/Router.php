<?php 

namespace Phalcon\CLI {    class Router implements \Phalcon\DI\InjectionAwareInterface
    {

        protected $_dependencyInjector;

        protected $_module;

        protected $_task;

        protected $_action;

        protected $_params;

        protected $_defaultModule;

        protected $_defaultTask;

        protected $_defaultAction;

        protected $_defaultParams;

        public function __construct()
        {
        }


        public function setDI($dependencyInjector)
        {
        }


        public function getDI()
        {
        }


        public function setDefaultModule($moduleName)
        {
        }


        public function setDefaultTask($taskName)
        {
        }


        public function setDefaultAction($actionName)
        {
        }


        public function handle($arguments=null)
        {
        }


        public function getModuleName()
        {
        }


        public function getTaskName()
        {
        }


        public function getActionName()
        {
        }


        public function getParams()
        {
        }

    }
}
