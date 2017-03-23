<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\Binding
 *
 * This is an class for binding models into params for handler
 */
class Binder implements \Phalcon\Mvc\Model\BinderInterface
{
    /**
     * Array for storing active bound models
     *
     * @var array
     */
    protected $boundModels = array();

    /**
     * Cache object used for caching parameters for model binding
     */
    protected $cache;

    /**
     * Internal cache for caching parameters for model binding during request
     */
    protected $internalCache = array();

    /**
     * Array for original values
     */
    protected $originalValues = array();


    /**
     * Array for storing active bound models
     *
     * @return array
     */
    public function getBoundModels() {}

    /**
     * Array for original values
     */
    public function getOriginalValues() {}

    /**
     * Phalcon\Mvc\Model\Binder constructor
     *
     * @param \Phalcon\Cache\BackendInterface $cache
     */
    public function __construct(\Phalcon\Cache\BackendInterface $cache = null) {}

    /**
     * Gets cache instance
     *
     * @param \Phalcon\Cache\BackendInterface $cache
     * @return BinderInterface
     */
    public function setCache(\Phalcon\Cache\BackendInterface $cache) {}

    /**
     * Sets cache instance
     *
     * @return \Phalcon\Cache\BackendInterface
     */
    public function getCache() {}

    /**
     * Bind models into params in proper handler
     *
     * @param object $handler
     * @param array $params
     * @param string $cacheKey
     * @param mixed $methodName
     * @return array
     */
    public function bindToHandler($handler, array $params, $cacheKey, $methodName = null) {}

    /**
     * Get params classes from cache by key
     *
     * @param string $cacheKey
     * @return array|null
     */
    protected function getParamsFromCache($cacheKey) {}

    /**
     * Get modified params for handler using reflection
     *
     * @param object $handler
     * @param array $params
     * @param string $cacheKey
     * @param mixed $methodName
     * @return array
     */
    protected function getParamsFromReflection($handler, array $params, $cacheKey, $methodName) {}

}
