<?php 

namespace Phalcon\Db\Profiler {

	/**
	 * Phalcon\Db\Profiler\Item
	 *
	 * This class identifies each profile in a Phalcon\Db\Profiler
	 *
	 */
	
	class Item {

		protected $_sqlStatement;

		protected $_initialTime;

		protected $_finalTime;

		/**
		 * Sets the SQL statement related to the profile
		 *
		 * @param string $sqlStatement
		 */
		public function setSQLStatement($sqlStatement){ }


		/**
		 * Returns the SQL statement related to the profile
		 *
		 * @return string
		 */
		public function getSQLStatement(){ }


		/**
		 * Sets the timestamp on when the profile started
		 *
		 * @param int $initialTime
		 */
		public function setInitialTime($initialTime){ }


		/**
		 * Sets the timestamp on when the profile ended
		 *
		 * @param int $finalTime
		 */
		public function setFinalTime($finalTime){ }


		/**
		 * Returns the initial time in milseconds on when the profile started
		 *
		 * @return double
		 */
		public function getInitialTime(){ }


		/**
		 * Returns the initial time in milseconds on when the profile ended
		 *
		 * @return double
		 */
		public function getFinalTime(){ }


		/**
		 * Returns the total time in seconds spent by the profile
		 *
		 * @return double
		 */
		public function getTotalElapsedSeconds(){ }

	}
}
