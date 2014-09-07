<?php 

namespace Phalcon {    interface DiInterface extends \ArrayAccess
        {

        public function set($name, $definition, $shared=null);


        public function remove($name);


        public function get($name, $parameters=null);


        public function getShared($name, $parameters=null);


        public function setService($rawDefinition);


        public function getService($name);


        public function has($name);


        public function wasFreshInstance();


        public function getServices();


        public static function setDefault($dependencyInjector);


        public static function getDefault();


        public static function reset();

    }
}
