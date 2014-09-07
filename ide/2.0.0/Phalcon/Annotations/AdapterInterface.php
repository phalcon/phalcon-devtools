<?php 

namespace Phalcon\Annotations {    interface AdapterInterface
        {

        public function read($key);


        public function write($key, $data);


        public function setReader($reader);


        public function getReader();


        public function get($className);


        public function getMethods($className);


        public function getMethod($className, $methodName);


        public function getProperties($className);


        public function getProperty($className, $propertyName);

    }
}
