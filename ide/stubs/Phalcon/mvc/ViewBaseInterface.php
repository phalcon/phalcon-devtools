<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\ViewInterface
 *
 * Interface for Phalcon\Mvc\View and Phalcon\Mvc\View\Simple
 */
interface ViewBaseInterface
{

    /**
     * Sets views directory. Depending of your platform, always add a trailing slash or backslash
     *
     * @param string $viewsDir
     */
    public function setViewsDir($viewsDir);

    /**
     * Gets views directory
     *
     * @return string
     */
    public function getViewsDir();

    /**
     * Adds parameters to views (alias of setVar)
     *
     * @param string $key
     * @param mixed $value
     */
    public function setParamToView($key, $value);

    /**
     * Adds parameters to views
     *
     * @param string $key
     * @param mixed $value
     */
    public function setVar($key, $value);

    /**
     * Returns parameters to views
     *
     * @return array
     */
    public function getParamsToView();

    /**
     * Returns the cache instance used to cache
     *
     * @return \Phalcon\Cache\BackendInterface
     */
    public function getCache();

    /**
     * Cache the actual view render to certain level
     *
     * @param mixed $options
     */
    public function cache($options = true);

    /**
     * Externally sets the view content
     *
     * @param string $content
     */
    public function setContent($content);

    /**
     * Returns cached output from another view stage
     *
     * @return string
     */
    public function getContent();

    /**
     * Renders a partial view
     *
     * @param string $partialPath
     * @param mixed $params
     * @return string
     */
    public function partial($partialPath, $params = null);

}
