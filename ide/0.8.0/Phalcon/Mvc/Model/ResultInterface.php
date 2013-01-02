<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\ResultInterface initializer
	 */
	
	interface ResultInterface {

		/**
		 * Forces that a model doesn't need to be checked if exists before store it
		 *
		 * @param boolean $forceExists
		 */
		public function setForceExists($forceExists);

	}
}
