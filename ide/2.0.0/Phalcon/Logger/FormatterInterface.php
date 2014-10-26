<?php 

namespace Phalcon\Logger {

    /**
     * Lacks of documentation
     */
    interface FormatterInterface
        {

        public function format($message, $type, $timestamp, $context=null);

    }
}
