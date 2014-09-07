<?php 

namespace Phalcon\Translate {    interface AdapterInterface
        {

        public function query($index, $placeholders=null);


        public function exists($index);

    }
}
