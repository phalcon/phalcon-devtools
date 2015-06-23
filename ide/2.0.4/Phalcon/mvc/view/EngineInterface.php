<?php

namespace Phalcon\Mvc\View;

/**
 * Phalcon\Mvc\View\EngineInterface
 * Interface for Phalcon\Mvc\View engine adapters
 */
interface EngineInterface
{

    /**
     * Phalcon\Mvc\View\Engine constructor
     *
     * @param mixed $view 
     * @param mixed $dependencyInjector 
     */
    public function __construct(\Phalcon\Mvc\ViewBaseInterface $view, \Phalcon\DiInterface $dependencyInjector = null);

    /**
     * Returns cached output on another view stage
     *
     * @return array 
     */
    public function getContent();

    /**
     * Renders a partial inside another view
     *
     * @param string $partialPath 
     * @return string 
     */
    public function partial($partialPath);

    /**
     * Renders a view using the template engine
     *
     * @param string $path 
     * @param mixed $params 
     * @param bool $mustClean 
     */
    public function render($path, $params, $mustClean = false);

}
