<?php 

namespace Phalcon\Mvc {    interface DispatcherInterface extends \Phalcon\DispatcherInterface
        {

        public function setControllerSuffix($controllerSuffix);


        public function setDefaultController($controllerName);


        public function setControllerName($controllerName, $isExact=null);


        public function getControllerName();


        public function getLastController();


        public function getActiveController();

    }
}
