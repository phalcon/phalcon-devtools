<?php 

namespace Phalcon\Acl {

    /**
     * Lacks of documentation
     */
    interface ResourceInterface
        {

        public function __construct($name, $description=null);


        public function getName();


        public function getDescription();


        public function __toString();

    }
}
