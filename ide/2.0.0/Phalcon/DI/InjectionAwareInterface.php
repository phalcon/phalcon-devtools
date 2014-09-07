<?php 

namespace Phalcon\DI {    interface InjectionAwareInterface
        {

        public function setDI($dependencyInjector);


        public function getDI();

    }
}
