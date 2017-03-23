<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\BinderInterface
 *
 * Interface for Phalcon\Mvc\Model\Binder
 */
interface BinderInterface
{

    /**
     * Gets active bound models
     *
     * @return array
     */
    public function getBoundModels();

    /**
     * Gets cache instance
     *
     * @return \Phalcon\Cache\BackendInterface
     */
    public function getCache();

    /**
     * Sets cache instance
     *
     * @param \Phalcon\Cache\BackendInterface $cache
     * @return BinderInterface
     */
    public function setCache(\Phalcon\Cache\BackendInterface $cache);

    /**
     * Bind models into params in proper handler
     *
     * @param object $handler
     * @param array $params
     * @param string $cacheKey
     * @param string $methodName
     * @return array
     */
    public function bindToHandler($handler, array $params, $cacheKey, $methodName = null);

}
