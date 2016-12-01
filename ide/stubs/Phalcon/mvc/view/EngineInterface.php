<?php

namespace Phalcon\Mvc\View;

/**
 * Phalcon\Mvc\View\EngineInterface
 *
 * Interface for Phalcon\Mvc\View engine adapters
 */
interface EngineInterface
{

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
     * @param mixed $params
     * @return string
     */
    public function partial($partialPath, $params = null);

    /**
     * Renders a view using the template engine
     *
     * @param string $path
     * @param mixed $params
     * @param bool $mustClean
     */
    public function render($path, $params, $mustClean = false);

}
