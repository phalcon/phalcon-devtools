<?php 

namespace Phalcon\Di {    interface InjectionAwareInterface
        {

        public function setDI($dependencyInjector);


        public function getDI();

    }
}
