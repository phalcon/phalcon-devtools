<?php

namespace Phalcon\Mvc\Model;

abstract class Resultset implements \Phalcon\Mvc\Model\ResultsetInterface, \Iterator, \SeekableIterator, \Countable, \ArrayAccess, \Serializable
{

    const TYPE_RESULT_FULL = 0;


    const TYPE_RESULT_PARTIAL = 1;


    const HYDRATE_RECORDS = 0;


    const HYDRATE_OBJECTS = 2;


    const HYDRATE_ARRAYS = 1;


    protected $_type = 0;


    protected $_result;


    protected $_cache;


    protected $_isFresh = true;


    protected $_pointer = -1;


    protected $_count;


    protected $_activeRow;


    protected $_rows;


    protected $_errorMessages;


    protected $_hydrateMode = 0;


    /**
     * Moves cursor to next row in the resultset
     */
	public function next() {}

    /**
     * Gets pointer number of active row in the resultset
     *
     * @return int 
     */
	public function key() {}

    /**
     * Rewinds resultset to its beginning
     */
	public final function rewind() {}

    /**
     * Changes internal pointer to a specific position in the resultset
     *
     * @param int $position 
     */
	public final function seek($position) {}

    /**
     * Counts how many rows are in the resultset
     *
     * @return int 
     */
	public final function count() {}

    /**
     * Checks whether offset exists in the resultset
     *
     * @param int $index 
     * @return boolean 
     */
	public function offsetExists($index) {}

    /**
     * Gets row in a specific position of the resultset
     *
     * @param int $index 
     * @return \Phalcon\Mvc\ModelInterface 
     */
	public function offsetGet($index) {}

    /**
     * Resulsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
     *
     * @param int $index 
     * @param \Phalcon\Mvc\ModelInterface $value 
     */
	public function offsetSet($index, $value) {}

    /**
     * Resulsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
     *
     * @param int $offset 
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
     * @return \Phalcon\Mvc\ModelInterface|boolean 
     */
	public function getFirst() {}

    /**
     * Get last row in the resultset
     *
     * @return \Phalcon\Mvc\ModelInterface| 
     */
	public function getLast() {}

    /**
     * Set if the resultset is fresh or an old one cached
     *
     * @param boolean $isFresh 
     * @return \Phalcon\Mvc\Model\Resultset 
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
     * @return \Phalcon\Mvc\Model\Resultset 
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
     * @return \Phalcon\Cache\BackendInterface 
     */
	public function getCache() {}

    /**
     * Returns current row in the resultset
     *
     * @return \Phalcon\Mvc\ModelInterface 
     */
	public final function current() {}

    /**
     * Returns the error messages produced by a batch operation
     *
     * @return \Phalcon\Mvc\Model\MessageInterface[] 
     */
	public function getMessages() {}

    /**
     * Updates every record in the resultset
     *
     * @param array $data 
     * @param Closure $conditionCallback 
     * @return boolean 
     */
	public function update($data, \Closure $conditionCallback = null) {}

    /**
     * Deletes every record in the resultset
     *
     * @param Closure $conditionCallback 
     * @return boolean 
     */
	public function delete(\Closure $conditionCallback = null) {}

    /**
     * Filters a resultset returning only those the developer requires
     * <code>
     * $filtered = $robots->filter(function($robot){
     * if ($robot->id < 3) {
     * return $robot;
     * }
     * });
     * </code>
     *
     * @param callback $filter 
     * @return \Phalcon\Mvc\Model[] 
     */
	public function filter($filter) {}

}
