<?php 

namespace Phalcon\Translate {

    /**
     * Lacks of documentation
     */
    interface AdapterInterface
        {

        public function t($translateKey, $placeholders=null);


        public function query($index, $placeholders=null);


        public function exists($index);

    }
}
