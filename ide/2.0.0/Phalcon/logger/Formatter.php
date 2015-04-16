<?php

namespace Phalcon\Logger;

abstract class Formatter
{

    /**
     * Returns the string meaning of a logger constant
     *
     * @param integer $type 
     * @return string 
     */
	public function getTypeString($type) {}

    /**
     * Interpolates context values into the message placeholders
     *
     * @see http://www.php-fig.org/psr/psr-3/ Section 1.2 Message
     * @param string $message 
     * @param mixed $context 
     * @param string $$message 
     * @param array $$context 
     */
	public function interpolate($message, $context = null) {}

}
