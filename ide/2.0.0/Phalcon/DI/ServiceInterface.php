<?php 

namespace Phalcon\DI {    interface ServiceInterface
        {

        public function getName();


        public function setShared($shared);


        public function isShared();


        public function setDefinition($definition);


        public function getDefinition();


        public function isResolved();


        public function resolve($parameters=null, $dependencyInjector=null);

    }
}
