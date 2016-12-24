<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\EntityInterface
 *
 * Interface for Phalcon\Mvc\Collection and Phalcon\Mvc\Model
 */
interface EntityInterface
{

    /**
     * Reads an attribute value by its name
     *
     * @param string $attribute
     * @return mixed
     */
    public function readAttribute($attribute);

    /**
     * Writes an attribute value by its name
     *
     * @param string $attribute
     * @param mixed $value
     */
    public function writeAttribute($attribute, $value);

}
