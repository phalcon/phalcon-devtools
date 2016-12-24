<?php

namespace Phalcon\Mvc\Controller;

/**
 * Phalcon\Mvc\Controller\BindModelInterface
 *
 * Interface for Phalcon\Mvc\Controller
 */
interface BindModelInterface
{

    /**
     * Return the model name associated with this controller
     *
     * @return string
     */
    public static function getModelName();

}
