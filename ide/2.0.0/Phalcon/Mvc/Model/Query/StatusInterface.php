<?php 

namespace Phalcon\Mvc\Model\Query {

    /**
     * Lacks of documentation
     */
    interface StatusInterface
        {

        public function __construct($success, $model);


        public function getModel();


        public function getMessages();


        public function success();

    }
}
