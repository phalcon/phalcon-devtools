<?php 

namespace Phalcon\Logger {

    /**
     * Phalcon\Logger\Adapter
     *
     * Base class for Phalcon\Logger adapters
     */
    abstract class Adapter implements \Phalcon\Logger\AdapterInterface
    {

        protected $_transaction;

        protected $_queue;

        protected $_formatter;

        protected $_logLevel;

        /**
         * Filters the logs sent to the handlers that are less or equal than a specific level
         *
         * @param int level
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function setLogLevel($level)
        {
        }


        /**
         * Returns the current log level
         *
         * @return int
         */
        public function getLogLevel()
        {
        }


        /**
         * Sets the message formatter
         *
         * @param \Phalcon\Logger\FormatterInterface formatter
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function setFormatter($formatter)
        {
        }


        public function isTransaction()
        {
        }


        /**
         * Starts a transaction
         *
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function begin()
        {
        }


        /**
         * Commits the internal transaction
         *
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function commit()
        {
        }


        /**
         * Rollbacks the internal transaction
         *
         * @return \Phalcon\Logger\Adapter
         */
        public function rollback()
        {
        }


        public function emergence($message, $context=null)
        {
        }


        /**
         * Logs messages to the internal loggger. Appends logs to the
         *
         * @param mixed type
         * @param string message
         * @param array $context
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function log($type, $message, $context=null)
        {
        }


        /**
         * Sends/Writes a debug message to the log
         *
         * @param string message
         * @param array $context
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function debug($message, $context=null)
        {
        }


        /**
         * Sends/Writes an info message to the log
         *
         * @param string message
         * @param array $context
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function info($message, $context=null)
        {
        }


        /**
         * Sends/Writes a notice message to the log
         *
         * @param string message
         * @param array $context
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function notice($message, $context=null)
        {
        }


        /**
         * Sends/Writes a warning message to the log
         *
         * @param string message
         * @param array $context
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function warning($message, $context=null)
        {
        }


        /**
         * Sends/Writes an error message to the log
         *
         * @param string message
         * @param array $context
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function error($message, $context=null)
        {
        }


        public function critical($message, $context=null)
        {
        }


        /**
         * Sends/Writes an alert message to the log
         *
         * @param string message
         * @param array $context
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function alert($message, $context=null)
        {
        }


        /**
         * Sends/Writes an emergency message to the log
         *
         * @param string message
         * @param array $context
         * @return \Phalcon\Logger\AdapterInterface
         */
        public function emergency($message, $context=null)
        {
        }


        abstract protected function logInternal($message, $type, $time, $context)
        {
        }

    }
}
