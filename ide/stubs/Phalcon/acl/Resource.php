<?php

namespace Phalcon\Acl;

/**
 * Phalcon\Acl\Resource
 * This class defines resource entity and its description
 */
class Resource implements \Phalcon\Acl\ResourceInterface
{
    /**
     * Resource name
     *
     * @var string
     */
    protected $_name;

    /**
     * Resource description
     *
     * @var string
     */
    protected $_description;


    /**
     * Resource name
     *
     * @return string 
     */
    public function getName() {}

    /**
     * Resource name
     *
     * @return string 
     */
    public function __toString() {}

    /**
     * Resource description
     *
     * @return string 
     */
    public function getDescription() {}

    /**
     * Phalcon\Acl\Resource constructor
     *
     * @param string $name 
     * @param string $description 
     */
    public function __construct($name, $description = null) {}

}
