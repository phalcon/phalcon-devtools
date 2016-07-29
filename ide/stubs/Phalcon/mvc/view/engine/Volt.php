<?php

namespace Phalcon\Mvc\View\Engine;

/**
 * Phalcon\Mvc\View\Engine\Volt
 * Designer friendly and fast template engine for PHP written in Zephir/C
 */
class Volt extends \Phalcon\Mvc\View\Engine implements \Phalcon\Mvc\View\EngineInterface
{

    protected $_options;


    protected $_compiler;


    protected $_macros;


    /**
     * Set Volt's options
     *
     * @param array $options 
     */
    public function setOptions(array $options) {}

    /**
     * Return Volt's options
     *
     * @return array 
     */
    public function getOptions() {}

    /**
     * Returns the Volt's compiler
     *
     * @return \Phalcon\Mvc\View\Engine\Volt\Compiler 
     */
    public function getCompiler() {}

    /**
     * Renders a view using the template engine
     *
     * @param string $templatePath 
     * @param mixed $params 
     * @param bool $mustClean 
     */
    public function render($templatePath, $params, $mustClean = false) {}

    /**
     * Length filter. If an array/object is passed a count is performed otherwise a strlen/mb_strlen
     *
     * @param mixed $item 
     * @return int 
     */
    public function length($item) {}

    /**
     * Checks if the needle is included in the haystack
     *
     * @param mixed $needle 
     * @param mixed $haystack 
     * @return bool 
     */
    public function isIncluded($needle, $haystack) {}

    /**
     * Performs a string conversion
     *
     * @param string $text 
     * @param string $from 
     * @param string $to 
     * @return string 
     */
    public function convertEncoding($text, $from, $to) {}

    /**
     * Extracts a slice from a string/array/traversable object value
     *
     * @param mixed $value 
     * @param int $start 
     * @param mixed $end 
     */
    public function slice($value, $start = 0, $end = null) {}

    /**
     * Sorts an array
     *
     * @param array $value 
     * @return array 
     */
    public function sort(array $value) {}

    /**
     * Checks if a macro is defined and calls it
     *
     * @param string $name 
     * @param array $arguments 
     * @return mixed 
     */
    public function callMacro($name, array $arguments = array()) {}

}
