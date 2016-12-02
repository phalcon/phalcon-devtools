<?php

namespace Phalcon;

/**
 * Phalcon\Debug
 *
 * Provides debug capabilities to Phalcon applications
 */
class Debug
{

    public $_uri = "//static.phalconphp.com/www/debug/3.0.x/";


    public $_theme = "default";


    protected $_hideDocumentRoot = false;


    protected $_showBackTrace = true;


    protected $_showFiles = true;


    protected $_showFileFragment = false;


    protected $_data;


    static protected $_isActive;


    /**
     * Change the base URI for static resources
     *
     * @param string $uri
     * @return Debug
     */
    public function setUri($uri) {}

    /**
     * Sets if files the exception's backtrace must be showed
     *
     * @param bool $showBackTrace
     * @return Debug
     */
    public function setShowBackTrace($showBackTrace) {}

    /**
     * Set if files part of the backtrace must be shown in the output
     *
     * @param bool $showFiles
     * @return Debug
     */
    public function setShowFiles($showFiles) {}

    /**
     * Sets if files must be completely opened and showed in the output
     * or just the fragment related to the exception
     *
     * @param bool $showFileFragment
     * @return Debug
     */
    public function setShowFileFragment($showFileFragment) {}

    /**
     * Listen for uncaught exceptions and unsilent notices or warnings
     *
     * @param bool $exceptions
     * @param bool $lowSeverity
     * @return Debug
     */
    public function listen($exceptions = true, $lowSeverity = false) {}

    /**
     * Listen for uncaught exceptions
     *
     * @return Debug
     */
    public function listenExceptions() {}

    /**
     * Listen for unsilent notices or warnings
     *
     * @return Debug
     */
    public function listenLowSeverity() {}

    /**
     * Halts the request showing a backtrace
     */
    public function halt() {}

    /**
     * Adds a variable to the debug output
     *
     * @param mixed $varz
     * @param string $key
     * @return Debug
     */
    public function debugVar($varz, $key = null) {}

    /**
     * Clears are variables added previously
     *
     * @return Debug
     */
    public function clearVars() {}

    /**
     * Escapes a string with htmlentities
     *
     * @param mixed $value
     * @return string
     */
    protected function _escapeString($value) {}

    /**
     * Produces a recursive representation of an array
     *
     * @param array $argument
     * @param mixed $n
     * @return string|null
     */
    protected function _getArrayDump(array $argument, $n = 0) {}

    /**
     * Produces an string representation of a variable
     *
     * @param mixed $variable
     * @return string
     */
    protected function _getVarDump($variable) {}

    /**
     * Returns the major framework's version
     *
     * @deprecated Will be removed in 4.0.0
     * @return string
     */
    public function getMajorVersion() {}

    /**
     * Generates a link to the current version documentation
     *
     * @return string
     */
    public function getVersion() {}

    /**
     * Returns the css sources
     *
     * @return string
     */
    public function getCssSources() {}

    /**
     * Returns the javascript sources
     *
     * @return string
     */
    public function getJsSources() {}

    /**
     * Shows a backtrace item
     *
     * @param int $n
     * @param array $trace
     */
    protected final function showTraceItem($n, array $trace) {}

    /**
     * Throws an exception when a notice or warning is raised
     *
     * @param mixed $severity
     * @param mixed $message
     * @param mixed $file
     * @param mixed $line
     * @param mixed $context
     */
    public function onUncaughtLowSeverity($severity, $message, $file, $line, $context) {}

    /**
     * Handles uncaught exceptions
     *
     * @param \Exception $exception
     * @return bool
     */
    public function onUncaughtException(\Exception $exception) {}

}
