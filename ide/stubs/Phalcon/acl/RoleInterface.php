<?php

namespace Phalcon\Acl;

/**
 * Phalcon\Acl\RoleInterface
 * Interface for Phalcon\Acl\Role
 */
interface RoleInterface
{

    /**
     * Returns the role name
     *
     * @return string 
     */
    public function getName();

    /**
     * Returns role description
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
