<?php

namespace Phalcon\Di;

/**
 * Phalcon\Di\ServiceInterface
 *
 * Represents a service in the services container
 */
interface ServiceInterface
{

    /**
     * Returns the service's name
     *
     * @param string
     */
    public function getName();

    /**
     * Sets if the service is shared or not
     *
     * @param bool $shared
     */
    public function setShared($shared);

    /**
     * Check whether the service is shared or not
     *
     * @return bool
     */
    public function isShared();

    /**
     * Set the service definition
     *
     * @param mixed $definition
     */
    public function setDefinition($definition);

    /**
     * Returns the service definition
     *
     * @return mixed
     */
    public function getDefinition();

    /**
     * Resolves the service
     *
     * @param array $parameters
     * @param \Phalcon\DiInterface $dependencyInjector
     * @return mixed
     */
    public function resolve($parameters = null, \Phalcon\DiInterface $dependencyInjector = null);

    /**
     * Changes a parameter in the definition without resolve the service
     *
     * @param int $position
     * @param array $parameter
     * @return ServiceInterface
     */
    public function setParameter($position, array $parameter);

    /**
     * Restore the internal state of a service
     *
     * @param array $attributes
     * @return ServiceInterface
     */
    public static function __set_state(array $attributes);

}
