<?php 

namespace Phalcon\Mvc {    interface ModuleDefinitionInterface
        {

        public function registerAutoloaders();


        public function registerServices($dependencyInjector);

    }
}
