<?php 

namespace Phalcon\Mvc\Micro {    interface CollectionInterface
        {

        public function setPrefix($prefix);


        public function getPrefix();


        public function getHandlers();


        public function setHandler($handler, $lazy=null);


        public function setLazy($lazy);


        public function isLazy();


        public function getHandler();


        public function map($routePattern, $handler);


        public function get($routePattern, $handler);


        public function post($routePattern, $handler);


        public function put($routePattern, $handler);


        public function patch($routePattern, $handler);


        public function head($routePattern, $handler);


        public function delete($routePattern, $handler);


        public function options($routePattern, $handler);

    }
}
