<?php

namespace Phalcon\Acl;

/**
 * Phalcon\Acl\ResourceInterface
 * Interface for Phalcon\Acl\Resource
 */
interface ResourceInterface
{

    /**
     * Returns the resource name
     *
     * @return string 
     */
    public function getName();

    /**
     * Returns resource description
     *
     * @return string 
     */
    public function getDescription();

    /**
     * Magic method __toString
     *
     * @return string 
     */
    public function __toString();

}
