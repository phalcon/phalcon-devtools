<?php

namespace Phalcon;

/**
 * Phalcon\Kernel
 *
 * This class allows to change the internal behavior of the framework in runtime
 */
class Kernel
{

    /**
     * Produces a pre-computed hash key based on a string. This function
     * produces different numbers in 32bit/64bit processors
     *
     * @param string $key
     * @return string
     */
    public static function preComputeHashKey($key) {}

}
