<?php

namespace Phalcon\Mvc\Model\Resultset;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Cache\BackendInterface;


class Simple extends Resultset
	implements \Iterator, \SeekableIterator, \Countable, \ArrayAccess, \Serializable
{

	protected $_model;

	protected $_columnMap;

	protected $_keepSnapshots = false;



	/**
	 * Phalcon\Mvc\Model\Resultset\Simple constructor
	 * 
	 * @param mixed $columnMap
	 * @param mixed $model
	 * @param \Phalcon\Db\Result\Pdo|null $result
	 * @param BackendInterface $cache
	 * @param boolean $keepSnapshots
	 *
	 */
	public function __construct($columnMap, $model, $result, BackendInterface $cache=null, $keepSnapshots=null) {}

	/**
		 * Set if the returned resultset must keep the record snapshots
		 *
	 * @return \ModelInterface|boolean
	 */
	public final function current() {}

	/**
		 * Current row is set by seek() operations
	 * 
	 * @param boolean $renameColumns
		 *
	 * @return array
	 */
	public function toArray($renameColumns=true) {}

	/**
		* If _rows is not present, fetchAll from database
		* and keep them in memory for further operations
		*
	 * @return string
	 */
	public function serialize() {}

	/**
		 * Serialize the cache using the serialize function
	 * 
	 * @param string $data
		 *
	 * @return void
	 */
	public function unserialize($data) {}

}
