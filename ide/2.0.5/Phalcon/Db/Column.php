<?php

namespace Phalcon\Db;

use Phalcon\Db\Exception;
use Phalcon\Db\ColumnInterface;


class Column implements ColumnInterface
{

	const TYPE_INTEGER = 0;

	const TYPE_DATE = 1;

	const TYPE_VARCHAR = 2;

	const TYPE_DECIMAL = 3;

	const TYPE_DATETIME = 4;

	const TYPE_CHAR = 5;

	const TYPE_TEXT = 6;

	const TYPE_FLOAT = 7;

	const TYPE_BOOLEAN = 8;

	const TYPE_DOUBLE = 9;

	const TYPE_TINYBLOB = 10;

	const TYPE_BLOB = 11;

	const TYPE_MEDIUMBLOB = 12;

	const TYPE_LONGBLOB = 13;

	const TYPE_BIGINTEGER = 14;

	const TYPE_JSON = 15;

	const TYPE_JSONB = 16;

	const BIND_PARAM_NULL = 0;

	const BIND_PARAM_INT = 1;

	const BIND_PARAM_STR = 2;

	const BIND_PARAM_BLOB = 3;

	const BIND_PARAM_BOOL = 5;

	const BIND_PARAM_DECIMAL = 32;

	const BIND_SKIP = 1024;



	/**
	 * Column's name
	 *
	 * @var string
	 */
	protected $_name;

	public function getName() {
		return $this->_name;
	}

	/**
	 * Schema which table related is
	 *
	 * @var string
	 */
	protected $_schemaName;

	public function getSchemaName() {
		return $this->_schemaName;
	}

	/**
	 * Column data type
	 *
	 * @var int|string
	 */
	protected $_type;

	public function getType() {
		return $this->_type;
	}

	/**
	 * Column data type reference
	 *
	 * @var int
	 */
	protected $_typeReference;

	public function getTypeReference() {
		return $this->_typeReference;
	}

	/**
	 * Column data type values
	 *
	 * @var array|string
	 */
	protected $_typeValues;

	public function getTypeValues() {
		return $this->_typeValues;
	}

	/**
	 * The column have some numeric type?
	 */
	protected $_isNumeric = false;

	/**
	 * Integer column size
	 *
	 * @var int
	 */
	protected $_size;

	public function getSize() {
		return $this->_size;
	}

	/**
	 * Integer column number scale
	 *
	 * @var int
	 */
	protected $_scale;

	public function getScale() {
		return $this->_scale;
	}

	/**
	 * Default column value
	 */
	protected $_default = null;

	public function getDefault() {
		return $this->_default;
	}

	/**
	 * Integer column unsigned?
	 *
	 * @var boolean
	 */
	protected $_unsigned = false;

	/**
	 * Column not nullable?
	 *
	 * @var boolean
	 */
	protected $_notNull = false;

	/**
	 * Column is part of the primary key?
	 */
	protected $_primary = false;

	/**
	 * Column is autoIncrement?
	 *
	 * @var boolean
	 */
	protected $_autoIncrement = false;

	/**
	 * Position is first
	 *
	 * @var boolean
	 */
	protected $_first = false;

	/**
	 * Column Position
	 *
	 * @var string
	 */
	protected $_after;

	/**
	 * Bind Type
	 */
	protected $_bindType = 2;



	/**
	 * Phalcon\Db\Column constructor
	 * 
	 * @param string $name
	 * @param array $definition
	 */
	public function __construct($name, array $definition) {}

	/**
		 * Get the column type, one of the TYPE_* constants
		 *
	 * @return boolean
	 */
	public function isUnsigned() {}

	/**
	 * Not null
	 *
	 * @return boolean
	 */
	public function isNotNull() {}

	/**
	 * Column is part of the primary key?
	 *
	 * @return boolean
	 */
	public function isPrimary() {}

	/**
	 * Auto-Increment
	 *
	 * @return boolean
	 */
	public function isAutoIncrement() {}

	/**
	 * Check whether column have an numeric type
	 *
	 * @return boolean
	 */
	public function isNumeric() {}

	/**
	 * Check whether column have first position in table
	 *
	 * @return boolean
	 */
	public function isFirst() {}

	/**
	 * Check whether field absolute to position in table
	 *
	 * @return mixed
	 */
	public function getAfterPosition() {}

	/**
	 * Returns the type of bind handling
	 *
	 * @return int
	 */
	public function getBindType() {}

	/**
	 * Restores the internal state of a Phalcon\Db\Column object
	 * 
	 * @param array $data
	 *
	 * @return Column
	 */
	public static function __set_state(array $data) {}

}
