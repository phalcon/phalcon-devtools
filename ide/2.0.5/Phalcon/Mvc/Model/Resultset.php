<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Db;
use Phalcon\Mvc\Model;
use Phalcon\Cache\BackendInterface;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\Model\ResultsetInterface;


abstract class Resultset
	implements ResultsetInterface, \Iterator, \SeekableIterator, \Countable, \ArrayAccess, \Serializable
{

	/**
	* Phalcon\Db\ResultInterface or false for empty resultset
	*/
	const TYPE_RESULT_FULL = 0;

	const TYPE_RESULT_PARTIAL = 1;

	const HYDRATE_RECORDS = 0;

	const HYDRATE_OBJECTS = 2;

	const HYDRATE_ARRAYS = 1;



	protected $_result = false;

	protected $_cache;

	protected $_isFresh = true;

	protected $_pointer;

	protected $_count;

	protected $_activeRow = null;

	protected $_rows = null;

	protected $_row = null;

	protected $_errorMessages;

	protected $_hydrateMode;



	/**
	 * Phalcon\Mvc\Model\Resultset constructor
	 * 
	 * @param \Phalcon\Db\ResultInterface|\false $result
	 * @param BackendInterface $cache
	 * @param array $columnTypes
	 *
	 */
	public function __construct($result, BackendInterface $cache=null) {}

	/**
		* 'false' is given as result for empty result-sets
		*
	 * @return void
	 */
	public function next() {}

	/**
	 * Check whether internal resource has rows to fetch
	 *
	 * @return boolean
	 */
	public function valid() {}

	/**
	 * Gets pointer number of active row in the resultset
	 *
	 * @return int|null
	 */
	public function key() {}

	/**
	 * Rewinds resultset to its beginning
	 *
	 * @return void
	 */
	public final function rewind() {}

	/**
	 * Changes internal pointer to a specific position in the resultset
	 * Set new position if required and set this->_row
	 * 
	 * @param int $position
	 *
	 * @return void
	 */
	public final function seek($position) {}

	/**
				* All rows are in memory
				*
	 * @return int
	 */
	public final function count() {}

	/**
	 * Checks whether offset exists in the resultset
	 * 
	 * @param int $index
	 *
	 * @return boolean
	 */
	public function offsetExists($index) {}

	/**
	 * Gets row in a specific position of the resultset
	 * 
	 * @param int $index
	 *
	 * @return ModelInterface|boolean
	 */
	public function offsetGet($index) {}

	/**
	   		 * Move the cursor to the specific position
	 * 
	 * @param mixed $index
	 * @param mixed $value
	   		 *
	 * @return void
	 */
	public function offsetSet($index, $value) {}

	/**
	 * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
	 * 
	 * @param int $offset
	 *
	 * @return void
	 */
	public function offsetUnset($offset) {}

	/**
	 * Returns the internal type of data retrieval that the resultset is using
	 *
	 * @return int
	 */
	public function getType() {}

	/**
	 * Get first row in the resultset
	 *
	 * @return ModelInterface|boolean
	 */
	public function getFirst() {}

	/**
	 * Get last row in the resultset
	 *
	 * @return ModelInterface|boolean
	 */
	public function getLast() {}

	/**
	 * Set if the resultset is fresh or an old one cached
	 * 
	 * @param boolean $isFresh
	 *
	 * @return Resultset
	 */
	public function setIsFresh($isFresh) {}

	/**
	 * Tell if the resultset if fresh or an old one cached
	 *
	 * @return boolean
	 */
	public function isFresh() {}

	/**
	 * Sets the hydration mode in the resultset
	 * 
	 * @param int $hydrateMode
	 *
	 * @return Resultset
	 */
	public function setHydrateMode($hydrateMode) {}

	/**
	 * Returns the current hydration mode
	 *
	 * @return int
	 */
	public function getHydrateMode() {}

	/**
	 * Returns the associated cache for the resultset
	 *
	 * @return BackendInterface
	 */
	public function getCache() {}

	/**
	 * Returns the error messages produced by a batch operation
	 *
	 * @return \Phalcon\Mvc\Model\MessageInterface[]
	 */
	public function getMessages() {}

	/**
	 * Updates every record in the resultset
	 *
	 * @param mixed $data
	 * @param \Closure $conditionCallback
	 * 
	 * @return boolean
	 */
	public function update($data, \Closure $conditionCallback=null) {}

	/**
				 * We only can update resultsets if every element is a complete object
	 * 
	 * @param \Closure $conditionCallback
				 *
	 * @return boolean
	 */
	public function delete(\Closure $conditionCallback=null) {}

	/**
				 * We only can delete resultsets if every element is a complete object
	 * 
	 * @param mixed $filter
				 *
	 * @return array
	 */
	public function filter($filter) {}

}
