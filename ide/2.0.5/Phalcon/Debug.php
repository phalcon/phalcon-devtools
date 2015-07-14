<?php

namespace Phalcon;

class Debug
{

	public $_uri = '//static.phalconphp.com/www/debug/2.0.0/';

	public $_theme = 'default';

	protected $_hideDocumentRoot = false;

	protected $_showBackTrace = true;

	protected $_showFiles = true;

	protected $_showFileFragment = false;

	protected $_data;

	protected static $_isActive;



	/**
	 * Change the base URI for static resources
	 * 
	 * @param string $uri
	 *
	 * @return Debug
	 */
	public function setUri($uri) {}

	/**
	 * Sets if files the exception"s backtrace must be showed
	 * 
	 * @param boolean $showBackTrace
	 *
	 * @return Debug
	 */
	public function setShowBackTrace($showBackTrace) {}

	/**
	 * Set if files part of the backtrace must be shown in the output
	 * 
	 * @param boolean $showFiles
	 *
	 * @return Debug
	 */
	public function setShowFiles($showFiles) {}

	/**
	 * Sets if files must be completely opened and showed in the output
	 * or just the fragment related to the exception
	 * 
	 * @param boolean $showFileFragment
	 *
	 * @return Debug
	 */
	public function setShowFileFragment($showFileFragment) {}

	/**
	 * Listen for uncaught exceptions and unsilent notices or warnings
	 * 
	 * @param boolean $exceptions
	 * @param boolean $lowSeverity
	 *
	 * @return Debug
	 */
	public function listen($exceptions=true, $lowSeverity=false) {}

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
	 *
	 * @return void
	 */
	public function halt() {}

	/**
	 * Adds a variable to the debug output
	 * 
	 * @param $varz
	 * @param string $key
	 *
	 * @return Debug
	 */
	public function debugVar($varz, $key=null) {}

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
	 *
	 * @return string
	 */
	protected function _escapeString($value) {}

	/**
	 * Produces a recursive representation of an array
	 * 
	 * @param array $argument
	 * @param $n
	 *
	 * @return string|null
	 */
	protected function _getArrayDump(array $argument, $n) {}

	/**
	 * Produces an string representation of a variable
	 * 
	 * @param mixed $variable
	 *
	 * @return string
	 */
	protected function _getVarDump($variable) {}

	/**
			 * Boolean variables are represented as "true"/"false"
			 *
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
	 *
	 * @return mixed
	 */
	protected final function showTraceItem($n, array $trace) {}

	/**
		 * Every trace in the backtrace have a unique number
	 * 
	 * @param $severity
	 * @param $message
	 * @param $file
	 * @param $line
		 *
	 * @return void
	 */
	public function onUncaughtLowSeverity($severity, $message, $file, $line) {}

	/**
	 * Handles uncaught exceptions
	 * 
	 * @param \Exception $exception
	 *
	 * @return boolean
	 */
	public function onUncaughtException(\Exception $exception) {}

}
