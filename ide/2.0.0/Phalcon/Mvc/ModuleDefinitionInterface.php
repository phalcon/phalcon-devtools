<?php 

namespace Phalcon\Mvc {    interface ModuleDefinitionInterface
        {

        public function registerAutoloaders($dependencyInjector=null);


        public function registerServices($dependencyInjector);

    }
}
