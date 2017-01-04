<?php

namespace Phalcon\Db;

class Index implements IndexInterface
{

	/**
	 * Index name
	 *
	 * @var string
	 */
	protected $_name;

	public function getName() {
		return $this->_name;
	}

	/**
	 * Index columns
	 *
	 * @var array
	 */
	protected $_columns;

	public function getColumns() {
		return $this->_columns;
	}

	/**
	 * Index type
	 *
	 * @var string
	 */
	protected $_type;

	public function getType() {
		return $this->_type;
	}



	/**
	 * Phalcon\Db\Index constructor
	 * 
	 * @param string $name
	 * @param array $columns
	 * @param $type
	 */
	public function __construct($name, array $columns, $type=null) {}

	/**
	 * Restore a Phalcon\Db\Index object from export
	 * 
	 * @param array $data
	 *
	 * @return Index
	 */
	public static function __set_state(array $data) {}

}
