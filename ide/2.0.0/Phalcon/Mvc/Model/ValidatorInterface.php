<?php 

namespace Phalcon\Mvc\Model {

    /**
     * Lacks of documentation
     */
    interface ValidatorInterface
        {

        public function getMessages();


        public function validate($record);

    }
}
