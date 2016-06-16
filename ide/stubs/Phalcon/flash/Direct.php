<?php

namespace Phalcon\Flash;

/**
 * Phalcon\Flash\Direct
 * This is a variant of the Phalcon\Flash that immediately outputs any message passed to it
 */
class Direct extends \Phalcon\Flash implements \Phalcon\FlashInterface
{

    /**
     * Outputs a message
     *
     * @param string $type 
     * @param mixed $message 
     * @return string 
     */
    public function message($type, $message) {}

    /**
     * Prints the messages accumulated in the flasher
     *
     * @param bool $remove 
     */
    public function output($remove = true) {}

}
