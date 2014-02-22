<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\ResultInterface initializer
	 */
	
	interface ResultInterface {

		/**
		 * Sets the object's state
		 *
		 * @param boolean $dirtyState
		 */
		public function setDirtyState($dirtyState);

	}
}
