<?php

namespace Phalcon\Mvc\Model\Binder;

/**
 * Phalcon\Mvc\Model\Binder\BindableInterface
 *
 * Interface for bindable classes
 */
interface BindableInterface
{

    /**
     * Return the model name or models names and parameters keys associated with this class
     *
     * @return string|array
     */
    public function getModelName();

}
