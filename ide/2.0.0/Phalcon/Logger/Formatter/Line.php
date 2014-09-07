<?php 

namespace Phalcon\Logger\Formatter {

    /**
     * Phalcon\Logger\Formatter\Line
     *
     * Formats messages using an one-line string
     */
    class Line extends \Phalcon\Logger\Formatter implements \Phalcon\Logger\FormatterInterface
    {

        protected $_dateFormat;

        protected $_format;

        /**
         * \Phalcon\Logger\Formatter\Line construct
         *
         * @param string format
         * @param string dateFormat
         */
        public function __construct($format=null, $dateFormat=null)
        {
        }


        /**
         * Format applied to each message
         *
         * @var string
         */
        public function setFormat($format)
        {
        }


        /**
         * Format applied to each message
         *
         * @var string
         */
        public function getFormat()
        {
        }


        /**
         * Default date format
         *
         * @var string
         */
        public function setDateFormat($date)
        {
        }


        /**
         * Default date format
         *
         * @var string
         */
        public function getDateFormat()
        {
        }


        /**
         * Applies a format to a message before sent it to the internal log
         *
         * @param string message
         * @param int type
         * @param int timestamp
         * @param array $context
         * @return string
         */
        public function format($message, $type, $timestamp, $context)
        {
        }

    }
}
