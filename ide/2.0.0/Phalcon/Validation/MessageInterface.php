<?php 

namespace Phalcon\Validation {    interface MessageInterface
        {

        public function setType($type);


        public function getType();


        public function setCode($code);


        public function getCode();


        public function setMessage($message);


        public function getMessage();


        public function setField($field);


        public function getField();


        public function __toString();

    }
}
