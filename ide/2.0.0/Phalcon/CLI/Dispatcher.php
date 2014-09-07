<?php 

namespace Phalcon\CLI {    class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface, \Phalcon\DispatcherInterface
    {

        const EXCEPTION_NO_DI = 0;

        const EXCEPTION_CYCLIC_ROUTING = 1;

        const EXCEPTION_HANDLER_NOT_FOUND = 2;

        const EXCEPTION_INVALID_HANDLER = 3;

        const EXCEPTION_INVALID_PARAMS = 4;

        const EXCEPTION_ACTION_NOT_FOUND = 5;

        protected $_handlerSuffix;

        protected $_defaultHandler;

        protected $_defaultAction;

        public function setTaskSuffix($taskSuffix)
        {
        }


        public function setDefaultTask($taskName)
        {
        }


        public function setTaskName($taskName)
        {
        }


        public function getTaskName()
        {
        }


        protected function _throwDispatchException()
        {
        }


        protected function _handleException()
        {
        }


        public function getTaskClass()
        {
        }


        public function getLastTask()
        {
        }


        public function getActiveTask()
        {
        }

    }
}
