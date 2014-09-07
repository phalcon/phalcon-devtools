<?php 

namespace Phalcon\Validation {    interface ValidatorInterface
        {

        public function isSetOption($key);


        public function getOption($key);


        public function validate($validator, $attribute);

    }
}
