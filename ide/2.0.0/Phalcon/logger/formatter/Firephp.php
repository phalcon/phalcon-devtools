<?php

namespace Phalcon\Logger\Formatter;

class Firephp extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface
{

    protected $_showBacktrace = true;


    protected $_enableLabels = true;


    /**
     * Returns the string meaning of a logger constant
     *
     * @param int $type 
     * @param integer $$type 
     * @return string 
     */
	public function getTypeString($type) {}

    /**
     * Returns the string meaning of a logger constant
     *
     * @param bool $isShow 
     * @return this 
     */
	public function setShowBacktrace($isShow = null) {}

    /**
     * Returns the string meaning of a logger constant
     *
     * @return boolean 
     */
	public function getShowBacktrace() {}

    /**
     * Returns the string meaning of a logger constant
     *
     * @param bool $isEnable 
     * @return this 
     */
	public function enableLabels($isEnable = null) {}

    /**
     * Returns the labels enabled
     *
     * @return boolean 
     */
	public function labelsEnabled() {}

    /**
     * Applies a format to a message before sending it to the log
     *
     * @param string $message 
     * @param int $type 
     * @param int $timestamp 
     * @param mixed $context 
     * @param string $$message 
     * @param int $$type 
     * @param int $$timestamp 
     * @param array $$context 
     * @return string 
     */
	public function format($message, $type, $timestamp, $context = null) {}

}
