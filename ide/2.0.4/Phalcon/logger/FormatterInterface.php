<?php

namespace Phalcon\Logger;

/**
 * Phalcon\Logger\FormatterInterface
 * This interface must be implemented by formmaters in Phalcon\Logger
 */
interface FormatterInterface
{

    /**
     * Applies a format to a message before sent it to the internal log
     *
     * @param string $message 
     * @param int $type 
     * @param int $timestamp 
     * @param mixed $context 
     * @param array $$context 
     */
    public function format($message, $type, $timestamp, $context = null);

}
