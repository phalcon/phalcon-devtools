<?php 

namespace Phalcon\Logger\Adapter {    class Firephp extends \Phalcon\Logger\Adapter implements \Phalcon\Logger\AdapterInterface
    {

        private static $_initialized;

        private static $_index;

        public function getFormatter()
        {
        }


        protected function logInternal($message, $type, $time, $context)
        {
        }


        public function close()
        {
        }

    }
}
