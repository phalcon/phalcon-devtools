<?php 

namespace Phalcon\Mvc\Model {    interface ValidatorInterface
        {

        public function getMessages();


        public function validate($record);

    }
}
