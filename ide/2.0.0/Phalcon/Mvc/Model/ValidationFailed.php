<?php 

namespace Phalcon\Mvc\Model {    class ValidationFailed extends \Phalcon\Mvc\Model\Exception
    {

        protected $_model;

        protected $_messages;

        public function __construct($model, $validationMessages)
        {
        }


        public function getMessages()
        {
        }


        public function getModel()
        {
        }

    }
}
