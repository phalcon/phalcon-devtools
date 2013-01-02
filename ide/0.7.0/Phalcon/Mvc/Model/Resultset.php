<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Resultset
	 *
	 * This component allows to Phalcon\Mvc\Model returns large resulsets with the minimum memory consumption
	 * Resulsets can be traversed using a standard foreach or a while statement. If a resultset is serialized
	 * it will dump all the rows into a big array. Then unserialize will retrieve the rows as they were before
	 * serializing.
	 *
	 * <code>
	 *
	 * //Using a standard foreach
	 * $robots = $Robots::find(array("type='virtual'", "order" => "name"));
	 * foreach($robots as $robot){
	 *  echo $robot->name, "\n";
	 * }
	 *
	 * //Using a while
	 * $robots = $Robots::find(array("type='virtual'", "order" => "name"));
	 * $robots->rewind();
	 * while($robots->valid()){
	 *  $robot = $robots->current();
	 *  echo $robot->name, "\n";
	 *  $robots->next();
	 * }
	 * </code>
	 *
	 */
	
	class Resultset {

		protected $_type;

		protected $_result;

		protected $_cache;

		protected $_isFresh;

		protected $_pointer;

		protected $_count;

		protected $_activeRow;

		protected $_rows;

		/**
		 * Moves cursor to next row in the resultset
		 *
		 */
		public function next(){ }


		/**
		 * Gets pointer number of active row in the resultset
		 *
		 * @return int
		 */
		public function key(){ }


		/**
		 * Rewinds resultset to its beginning
		 *
		 */
		public function rewind(){ }


		/**
		 * Changes internal pointer to a specific position in the resultset
		 *
		 * @param int $position
		 */
		public function seek($position){ }


		/**
		 * Counts how many rows are in the resultset
		 *
		 * @return int
		 */
		public function count(){ }


		/**
		 * Checks whether offset exists in the resultset
		 *
		 * @param int $index
		 * @return boolean
		 */
		public function offsetExists($index){ }


		/**
		 * Gets row in a specific position of the resultset
		 *
		 * @param int $index
		 * @return \Phalcon\Mvc\Model
		 */
		public function offsetGet($index){ }


		/**
		 * Resulsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 *
		 * @param int $index
		 * @param \Phalcon\Mvc\Model $value
		 */
		public function offsetSet($index, $value){ }


		/**
		 * Resulsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 *
		 * @param int $offset
		 */
		public function offsetUnset($offset){ }


		/**
		 * Get first row in the resultset
		 *
		 * @return \Phalcon\Mvc\Model
		 */
		public function getFirst(){ }


		/**
		 * Get last row in the resultset
		 *
		 * @return \Phalcon\Mvc\Model
		 */
		public function getLast(){ }


		/**
		 * Set if the resultset is fresh or an old one cached
		 *
		 * @param boolean $isFresh
		 */
		public function setIsFresh($isFresh){ }


		/**
		 * Tell if the resultset if fresh or an old one cached
		 *
		 * @return boolean
		 */
		public function isFresh(){ }


		/**
		 * Returns the associated cache for the resultset
		 *
		 * @return \Phalcon\Cache\Backend
		 */
		public function getCache(){ }


		/**
		 * Returns current row in the resultset
		 *
		 * @return object
		 */
		public function current(){ }

	}
}
