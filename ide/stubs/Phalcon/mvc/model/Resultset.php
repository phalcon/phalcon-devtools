<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\Resultset
 *
 * This component allows to Phalcon\Mvc\Model returns large resultsets with the minimum memory consumption
 * Resultsets can be traversed using a standard foreach or a while statement. If a resultset is serialized
 * it will dump all the rows into a big array. Then unserialize will retrieve the rows as they were before
 * serializing.
 *
 * <code>
 *
 * // Using a standard foreach
 * $robots = Robots::find(
 *     [
 *         "type = 'virtual'",
 *         "order" => "name",
 *     ]
 * );
 *
 * foreach ($robots as robot) {
 *     echo robot->name, "\n";
 * }
 *
 * // Using a while
 * $robots = Robots::find(
 *     [
 *         "type = 'virtual'",
 *         "order" => "name",
 *     ]
 * );
 *
 * $robots->rewind();
 *
 * while ($robots->valid()) {
 *     $robot = $robots->current();
 *
 *     echo $robot->name, "\n";
 *
 *     $robots->next();
 * }
 * </code>
 */
abstract class Resultset implements \Phalcon\Mvc\Model\ResultsetInterface, \Iterator, \SeekableIterator, \Countable, \ArrayAccess, \Serializable, \JsonSerializable
{

    const TYPE_RESULT_FULL = 0;


    const TYPE_RESULT_PARTIAL = 1;


    const HYDRATE_RECORDS = 0;


    const HYDRATE_OBJECTS = 2;


    const HYDRATE_ARRAYS = 1;

    /**
     * Phalcon\Db\ResultInterface or false for empty resultset
     */
    protected $_result = false;


    protected $_cache;


    protected $_isFresh = true;


    protected $_pointer = 0;


    protected $_count;


    protected $_activeRow = null;


    protected $_rows = null;


    protected $_row = null;


    protected $_errorMessages;


    protected $_hydrateMode = 0;


    /**
     * Phalcon\Mvc\Model\Resultset constructor
     *
     * @param \Phalcon\Db\ResultInterface|false $result
     * @param \Phalcon\Cache\BackendInterface $cache
     */
    public function __construct($result, \Phalcon\Cache\BackendInterface $cache = null) {}

    /**
     * Moves cursor to next row in the resultset
     */
    public function next() {}

    /**
     * Check whether internal resource has rows to fetch
     *
     * @return bool
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
     */
    public final function rewind() {}

    /**
     * Changes internal pointer to a specific position in the resultset
     * Set new position if required and set this->_row
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
     * @return bool
     */
    public function offsetExists($index) {}

    /**
     * Gets row in a specific position of the resultset
     *
     * @param int $index
     * @return bool|\Phalcon\Mvc\ModelInterface
     */
    public function offsetGet($index) {}

    /**
     * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
     *
     * @param int $index
     * @param \Phalcon\Mvc\ModelInterface $value
     */
    public function offsetSet($index, $value) {}

    /**
     * Resultsets cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
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
     * @return bool|\Phalcon\Mvc\ModelInterface
     */
    public function getFirst() {}

    /**
     * Get last row in the resultset
     *
     * @return bool|\Phalcon\Mvc\ModelInterface
     */
    public function getLast() {}

    /**
     * Set if the resultset is fresh or an old one cached
     *
     * @param bool $isFresh
     * @return Resultset
     */
    public function setIsFresh($isFresh) {}

    /**
     * Tell if the resultset if fresh or an old one cached
     *
     * @return bool
     */
    public function isFresh() {}

    /**
     * Sets the hydration mode in the resultset
     *
     * @param int $hydrateMode
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
     * @return \Phalcon\Cache\BackendInterface
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
     * @param array $data
     * @param \Closure $conditionCallback
     * @return bool
     */
    public function update($data, \Closure $conditionCallback = null) {}

    /**
     * Deletes every record in the resultset
     *
     * @param \Closure $conditionCallback
     * @return bool
     */
    public function delete(\Closure $conditionCallback = null) {}

    /**
     * Filters a resultset returning only those the developer requires
     *
     * <code>
     * $filtered = $robots->filter(
     *     function ($robot) {
     *         if ($robot->id < 3) {
     *             return $robot;
     *         }
     *     }
     * );
     * </code>
     *
     * @param callback $filter
     * @return array
     */
    public function filter($filter) {}

    /**
     * Returns serialised model objects as array for json_encode.
     * Calls jsonSerialize on each object if present
     *
     * <code>
     * $robots = Robots::find();
     * echo json_encode($robots);
     * </code>
     *
     * @return array
     */
    public function jsonSerialize() {}

}
