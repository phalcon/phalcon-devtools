<?php 

namespace Phalcon {    class DI implements \Phalcon\DiInterface
    {

        protected static $_default;

        public function __construct()
        {
        }


        public function set($name, $definition, $shared=null)
        {
        }


        public function remove($name)
        {
        }


        public function getRaw($name)
        {
        }


        public function getService($name)
        {
        }


        public function setService($rawDefinition)
        {
        }


        public function get($name, $parameters=null)
        {
        }


        public function getShared($name, $parameters=null)
        {
        }


        public function has($name)
        {
        }


        public function wasFreshInstance()
        {
        }


        public function getServices()
        {
        }


        public static function setDefault($dependencyInjector)
        {
        }


        public static function getDefault()
        {
        }


        public static function reset()
        {
        }


        public function attempt($name, $definition, $shared=null)
        {
        }


        public function setShared($name, $definition)
        {
        }


        public function setRaw($rawDefinition)
        {
        }


        public function offsetExists($property)
        {
        }


        public function offsetSet($property, $value)
        {
        }


        public function offsetGet($property)
        {
        }


        public function offsetUnset($property)
        {
        }


        public function __call($method, $arguments=null)
        {
        }


        public function __clone()
        {
        }

    }
}
