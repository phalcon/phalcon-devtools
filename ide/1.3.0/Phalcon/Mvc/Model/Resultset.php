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
	 * $robots = Robots::find(array("type='virtual'", "order" => "name"));
	 * foreach ($robots as $robot) {
	 *  echo $robot->name, "\n";
	 * }
	 *
	 * //Using a while
	 * $robots = Robots::find(array("type='virtual'", "order" => "name"));
	 * $robots->rewind();
	 * while ($robots->valid()) {
	 *  $robot = $robots->current();
	 *  echo $robot->name, "\n";
	 *  $robots->next();
	 * }
	 * </code>
	 *
	 */
	
	abstract class Resultset implements \Phalcon\Mvc\Model\ResultsetInterface, \Iterator, \Traversable, \SeekableIterator, \Countable, \ArrayAccess, \Serializable {

		const TYPE_RESULT_FULL = 0;

		const TYPE_RESULT_PARTIAL = 1;

		const HYDRATE_RECORDS = 0;

		const HYDRATE_OBJECTS = 2;

		const HYDRATE_ARRAYS = 1;

		protected $_type;

		protected $_result;

		protected $_cache;

		protected $_isFresh;

		protected $_pointer;

		protected $_count;

		protected $_activeRow;

		protected $_rows;

		protected $_errorMessages;

		protected $_hydrateMode;

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
		public function offsetExists($property){ }


		/**
		 * Gets row in a specific position of the resultset
		 *
		 * @param int $index
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function offsetGet($property){ }


		/**
		 * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 *
		 * @param int $index
		 * @param \Phalcon\Mvc\ModelInterface $value
		 */
		public function offsetSet($property, $value){ }


		/**
		 * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
		 *
		 * @param int $offset
		 */
		public function offsetUnset($property){ }


		/**
		 * Returns the internal type of data retrieval that the resultset is using
		 *
		 * @return int
		 */
		public function getType(){ }


		/**
		 * Get first row in the resultset
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getFirst(){ }


		/**
		 * Get last row in the resultset
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getLast(){ }


		/**
		 * Set if the resultset is fresh or an old one cached
		 *
		 * @param boolean $isFresh
		 * @return \Phalcon\Mvc\Model\Resultset
		 */
		public function setIsFresh($isFresh){ }


		/**
		 * Tell if the resultset if fresh or an old one cached
		 *
		 * @return boolean
		 */
		public function isFresh(){ }


		/**
		 * Sets the hydration mode in the resultset
		 *
		 * @param int $hydrateMode
		 * @return \Phalcon\Mvc\Model\Resultset
		 */
		public function setHydrateMode($hydrateMode){ }


		/**
		 * Returns the current hydration mode
		 *
		 * @return int
		 */
		public function getHydrateMode(){ }


		/**
		 * Returns the associated cache for the resultset
		 *
		 * @return \Phalcon\Cache\BackendInterface
		 */
		public function getCache(){ }


		/**
		 * Returns current row in the resultset
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function current(){ }


		/**
		 * Returns the error messages produced by a batch operation
		 *
		 * @return \Phalcon\Mvc\Model\MessageInterface[]
		 */
		public function getMessages(){ }


		/**
		 * Deletes every record in the resultset
		 *
		 * @param Closure $conditionCallback
		 * @return boolean
		 */
		public function delete($conditionCallback=null){ }


		/**
		 * Filters a resultset returning only those the developer requires
		 *
		 *<code>
		 * $filtered = $robots->filter(function($robot){
		 *		if ($robot->id < 3) {
		 *			return $robot;
		 *		}
		 *	});
		 *</code>
		 *
		 * @param callback $filter
		 * @return \Phalcon\Mvc\Model[]
		 */
		public function filter($filter){ }

	}
}
