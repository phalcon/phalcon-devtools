<?php 

namespace Phalcon\Db\Profiler {

    /**
     * Phalcon\Db\Profiler\Item
     *
     * This class identifies each profile in a Phalcon\Db\Profiler
     *
     */
    class Item
    {

        protected $_sqlStatement;

        protected $_sqlVariables;

        protected $_sqlBindTypes;

        protected $_initialTime;

        protected $_finalTime;

        public function setSQLStatement($sqlStatement)
        {
        }


        public function getSQLStatement()
        {
        }


        public function setSQLVariables($sqlVariables)
        {
        }


        public function getSQLVariables()
        {
        }


        public function setSQLBindTypes($sqlBindTypes)
        {
        }


        public function getSQLBindTypes()
        {
        }


        /**
         * Timestamp when the profile started
         *
         * @var double
         */
        public function setInitialTime($initialTime)
        {
        }


        /**
         * Timestamp when the profile ended
         *
         * @var double
         */
        public function setFinalTime($finalTime)
        {
        }


        /**
         * Timestamp when the profile started
         *
         * @var double
         */
        public function getInitialTime()
        {
        }


        /**
         * Timestamp when the profile ended
         *
         * @var double
         */
        public function getFinalTime()
        {
        }


        /**
         * Returns the total time in seconds spent by the profile
         *
         * @return double
         */
        public function getTotalElapsedSeconds()
        {
        }

    }
}
