<?php 

namespace Phalcon\Validation {

    /**
     * Lacks of documentation
     */
    interface ValidatorInterface
        {

        public function isSetOption($key);


        public function getOption($key);


        public function validate($validator, $attribute);

    }
}
