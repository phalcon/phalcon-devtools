<?php 

namespace Phalcon\Http\Request {

    /**
     * Lacks of documentation
     */
    interface FileInterface
        {

        public function __construct($file, $key=null);


        public function getSize();


        public function getName();


        public function getTempName();


        public function getType();


        public function getRealType();


        public function moveTo($destination);

    }
}
