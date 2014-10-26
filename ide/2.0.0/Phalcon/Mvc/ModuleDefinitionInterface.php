<?php 

namespace Phalcon\Mvc {

    /**
     * Lacks of documentation
     */
    interface ModuleDefinitionInterface
        {

        public function registerAutoloaders($dependencyInjector=null);


        public function registerServices($dependencyInjector);

    }
}
