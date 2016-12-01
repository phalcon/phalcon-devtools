<?php

namespace Phalcon\Acl;

/**
 * Phalcon\Acl\Role
 *
 * This class defines role entity and its description
 */
class Role implements \Phalcon\Acl\RoleInterface
{
    /**
     * Role name
     *
     * @var string
     */
    protected $_name;

    /**
     * Role description
     *
     * @var string
     */
    protected $_description;


    /**
     * Role name
     *
     * @return string
     */
    public function getName() {}

    /**
     * Role name
     *
     * @return string
     */
    public function __toString() {}

    /**
     * Role description
     *
     * @return string
     */
    public function getDescription() {}

    /**
     * Phalcon\Acl\Role constructor
     *
     * @param string $name
     * @param string $description
     */
    public function __construct($name, $description = null) {}

}
