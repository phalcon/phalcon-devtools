<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\ResultsetInterface initializer
	 */
	
	interface ResultsetInterface {

		/**
		 * Get first row in the resultset
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getFirst();


		/**
		 * Get last row in the resultset
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getLast();


		/**
		 * Set if the resultset is fresh or an old one cached
		 *
		 * @param boolean $isFresh
		 */
		public function setIsFresh($isFresh);


		/**
		 * Tell if the resultset if fresh or an old one cached
		 *
		 * @return boolean
		 */
		public function isFresh();


		/**
		 * Returns the associated cache for the resultset
		 *
		 * @return \Phalcon\Cache\BackendInterface
		 */
		public function getCache();

	}
}
