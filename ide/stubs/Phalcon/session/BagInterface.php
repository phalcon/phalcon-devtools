<?php

namespace Phalcon\Session;

/**
 * Phalcon\Session\BagInterface
 *
 * Interface for Phalcon\Session\Bag
 */
interface BagInterface
{

    /**
     * Initializes the session bag. This method must not be called directly, the
     * class calls it when its internal data is accessed
     */
    public function initialize();

    /**
     * Destroys the session bag
     */
    public function destroy();

    /**
     * Setter of values
     *
     * @param string $property
     * @param mixed $value
     */
    public function set($property, $value);

    /**
     * Getter of values
     *
     * @param string $property
     * @param mixed $defaultValue
     * @return mixed
     */
    public function get($property, $defaultValue = null);

    /**
     * Isset property
     *
     * @param string $property
     * @return bool
     */
    public function has($property);

    /**
     * Setter of values
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value);

    /**
     * Getter of values
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property);

    /**
     * Isset property
     *
     * @param string $property
     * @return bool
     */
    public function __isset($property);

}
