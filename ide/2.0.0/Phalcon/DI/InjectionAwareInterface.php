<?php 

namespace Phalcon\Di {

    /**
     * Lacks of documentation
     */
    interface InjectionAwareInterface
        {

        public function setDI($dependencyInjector);


        public function getDI();

    }
}
