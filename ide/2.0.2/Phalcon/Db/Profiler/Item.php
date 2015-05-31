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

		protected $_sqlVariables;

		protected $_sqlBindTypes;

		protected $_initialTime;

		protected $_finalTime;

		/**
		 * SQL statement related to the profile
		 *
		 * @var string
		 */
		public function setSqlStatement($sqlStatement){ }


		/**
		 * SQL statement related to the profile
		 *
		 * @var string
		 */
		public function getSqlStatement(){ }


		/**
		 * SQL variables related to the profile
		 *
		 * @var array
		 */
		public function setSqlVariables($sqlVariables){ }


		/**
		 * SQL variables related to the profile
		 *
		 * @var array
		 */
		public function getSqlVariables(){ }


		/**
		 * SQL bind types related to the profile
		 *
		 * @var array
		 */
		public function setSqlBindTypes($sqlBindTypes){ }


		/**
		 * SQL bind types related to the profile
		 *
		 * @var array
		 */
		public function getSqlBindTypes(){ }


		/**
		 * Timestamp when the profile started
		 *
		 * @var double
		 */
		public function setInitialTime($initialTime){ }


		/**
		 * Timestamp when the profile started
		 *
		 * @var double
		 */
		public function getInitialTime(){ }


		/**
		 * Timestamp when the profile ended
		 *
		 * @var double
		 */
		public function setFinalTime($finalTime){ }


		/**
		 * Timestamp when the profile ended
		 *
		 * @var double
		 */
		public function getFinalTime(){ }


		/**
		 * Returns the total time in seconds spent by the profile
		 */
		public function getTotalElapsedSeconds(){ }

	}
}
