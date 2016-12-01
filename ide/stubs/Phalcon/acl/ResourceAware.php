<?php

namespace Phalcon\Acl;

/**
 * Phalcon\Acl\ResourceAware
 *
 * Interface for classes which could be used in allow method as RESOURCE
 */
interface ResourceAware
{

    /**
     * Returns resource name
     *
     * @return string
     */
    public function getResourceName();

}
