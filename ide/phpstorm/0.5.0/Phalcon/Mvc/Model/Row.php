<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Row
	 *
	 * This component allows Phalcon\Mvc\Model to return rows without an associated entity.
	 * This objects implements the ArrayAccess interfase to allow access the object as object->x or array[x].
	 */
	
	class Row {

		public function setForceExists(){ }


		/**
		 * Checks whether offset exists in the row
		 *
		 * @param int $index
		 * @return boolean
		 */
		public function offsetExists($index){ }


		/**
		 * Gets row in a specific position of the row
		 *
		 * @param int $index
		 * @return string|Phalcon\Mvc\Model
		 */
		public function offsetGet($index){ }


		/**
		 * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 *
		 * @param int $index
		 * @param \Phalcon\Mvc\Model $value
		 */
		public function offsetSet($index, $value){ }


		/**
		 * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 *
		 * @param int $offset
		 */
		public function offsetUnset($offset){ }

	}
}
