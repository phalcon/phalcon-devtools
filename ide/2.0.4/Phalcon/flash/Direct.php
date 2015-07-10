<?php

namespace Phalcon\Flash;

/**
 * Phalcon\Flash\Direct
 * This is a variant of the Phalcon\Flash that inmediately outputs any message passed to it
 */
class Direct extends \Phalcon\Flash implements \Phalcon\FlashInterface
{

    /**
     * Outputs a message
     *
     * @param string $type 
<<<<<<< HEAD
     * @param mixed $message 
=======
     * @param string|array $message 
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     * @return string 
     */
    public function message($type, $message) {}

<<<<<<< HEAD
    /**
     * Prints the messages accumulated in the flasher
     *
     * @param bool $remove 
     */
    public function output($remove = true) {}

=======
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
}
