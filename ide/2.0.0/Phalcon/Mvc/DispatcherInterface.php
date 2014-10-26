<?php 

namespace Phalcon\Mvc {

    /**
     * Lacks of documentation
     */
    interface DispatcherInterface extends \Phalcon\DispatcherInterface
        {

        public function setControllerSuffix($controllerSuffix);


        public function setDefaultController($controllerName);


        public function setControllerName($controllerName);


        public function getControllerName();


        public function getLastController();


        public function getActiveController();

    }
}
