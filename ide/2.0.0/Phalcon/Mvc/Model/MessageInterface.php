<?php 

namespace Phalcon\Mvc\Model {    interface MessageInterface
        {

        public function setType($type);


        public function getType();


        public function setMessage($message);


        public function getMessage();


        public function setField($field);


        public function getField();

    }
}
