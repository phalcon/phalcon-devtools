<?php

namespace Phalcon\Logger\Formatter;

/**
 * Phalcon\Logger\Formatter\Firephp
 *
 * Formats messages so that they can be sent to FirePHP
 */
class Firephp extends \Phalcon\Logger\Formatter
{

    protected $_showBacktrace = true;


    protected $_enableLabels = true;


    /**
     * Returns the string meaning of a logger constant
     *
     * @param int $type
     * @return string
     */
    public function getTypeString($type) {}

    /**
     * Returns the string meaning of a logger constant
     *
     * @param bool $isShow
     * @return Firephp
     */
    public function setShowBacktrace($isShow = null) {}

    /**
     * Returns the string meaning of a logger constant
     *
     * @return bool
     */
    public function getShowBacktrace() {}

    /**
     * Returns the string meaning of a logger constant
     *
     * @param bool $isEnable
     * @return Firephp
     */
    public function enableLabels($isEnable = null) {}

    /**
     * Returns the labels enabled
     *
     * @return bool
     */
    public function labelsEnabled() {}

    /**
     * Applies a format to a message before sending it to the log
     *
     * @param array $context
     *
     * @param string $message
     * @param int $type
     * @param int $timestamp
     * @param mixed $context
     * @param string $$message
     * @param int $$type
     * @param int $$timestamp
     * @return string
     */
    public function format($message, $type, $timestamp, $context = null) {}

}
