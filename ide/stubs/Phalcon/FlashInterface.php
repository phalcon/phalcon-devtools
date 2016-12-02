<?php

namespace Phalcon;

/**
 * Phalcon\FlashInterface
 *
 * Interface for Phalcon\Flash
 */
interface FlashInterface
{

    /**
     * Shows a HTML error message
     *
     * @param mixed $message
     */
    public function error($message);

    /**
     * Shows a HTML notice/information message
     *
     * @param mixed $message
     */
    public function notice($message);

    /**
     * Shows a HTML success message
     *
     * @param mixed $message
     */
    public function success($message);

    /**
     * Shows a HTML warning message
     *
     * @param mixed $message
     */
    public function warning($message);

    /**
     * Outputs a message
     *
     * @param string $type
     * @param mixed $message
     */
    public function message($type, $message);

}
