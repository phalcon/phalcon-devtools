<?php

namespace Phalcon\Mvc\Model\Resultset;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\ResultsetInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Cache\BackendInterface;
use Phalcon\Db\ResultInterface;
use Phalcon\Mvc\Model\Row;


class Complex extends Resultset implements ResultsetInterface
{

	protected $_columnTypes;

	/**
	* Unserialised result-set hydrated all rows already. unserialise() sets _disableHydration to true
	*/
	protected $_disableHydration = false;



	/**
	 * Phalcon\Mvc\Model\Resultset\Complex constructor
	 * 
	 * @param mixed $columnTypes
	 * @param ResultInterface $result
	 * @param BackendInterface $cache
	 *
	 */
	public function __construct($columnTypes, ResultInterface $result=null, BackendInterface $cache=null) {}

	/**
		 * Column types, tell the resultset how to build the result
		 *
	 * @return \ModelInterface|boolean
	 */
	public final function current() {}

	/**
		 * Current row is set by seek() operations
		 *
	 * @return array
	 */
	public function toArray() {}

	/**
	 * Serializing a resultset will dump all related rows into a big array
	 *
	 * @return string
	 */
	public function serialize() {}

	/**
		 * Obtain the records as an array
	 * 
	 * @param string $data
		 *
	 * @return void
	 */
	public function unserialize($data) {}

}
