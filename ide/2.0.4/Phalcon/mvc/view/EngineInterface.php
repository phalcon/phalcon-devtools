<?php

namespace Phalcon\Mvc\View;

/**
 * Phalcon\Mvc\View\EngineInterface
 * Interface for Phalcon\Mvc\View engine adapters
 */
interface EngineInterface
{

    /**
<<<<<<< HEAD
=======
     * Phalcon\Mvc\View\Engine constructor
     *
     * @param mixed $view 
     * @param mixed $dependencyInjector 
     */
    public function __construct(\Phalcon\Mvc\ViewBaseInterface $view, \Phalcon\DiInterface $dependencyInjector = null);

    /**
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146
     * Returns cached output on another view stage
     *
     * @return array 
     */
    public function getContent();

    /**
     * Renders a partial inside another view
     *
     * @param string $partialPath 
<<<<<<< HEAD
     * @param mixed $params 
     * @return string 
     */
    public function partial($partialPath, $params = null);
=======
     * @return string 
     */
    public function partial($partialPath);
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146

    /**
     * Renders a view using the template engine
     *
     * @param string $path 
     * @param mixed $params 
     * @param bool $mustClean 
     */
    public function render($path, $params, $mustClean = false);

}
