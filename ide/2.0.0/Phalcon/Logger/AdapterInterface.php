<?php 

namespace Phalcon\Logger {    interface AdapterInterface
        {

        public function setFormatter($formatter);


        public function getFormatter();


        public function setLogLevel($level);


        public function getLogLevel();


        public function begin();


        public function commit();


        public function rollback();


        public function close();


        public function log($type, $message, $context=null);


        public function debug($message, $context=null);


        public function info($message, $context=null);


        public function notice($message, $context=null);


        public function warning($message, $context=null);


        public function error($message, $context=null);


        public function critical($message, $context=null);


        public function alert($message, $context=null);


        public function emergency($message, $context=null);

    }
}
