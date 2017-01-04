<?php

namespace Phalcon\Db;

class Reference implements ReferenceInterface
{

	/**
	 * Constraint name
	 *
	 * @var string
	 */
	protected $_name;

	public function getName() {
		return $this->_name;
	}

	protected $_schemaName;

	public function getSchemaName() {
		return $this->_schemaName;
	}

	protected $_referencedSchema;

	public function getReferencedSchema() {
		return $this->_referencedSchema;
	}

	/**
	 * Referenced Table
	 *
	 * @var string
	 */
	protected $_referencedTable;

	public function getReferencedTable() {
		return $this->_referencedTable;
	}

	/**
	 * Local reference columns
	 *
	 * @var array
	 */
	protected $_columns;

	public function getColumns() {
		return $this->_columns;
	}

	/**
	 * Referenced Columns
	 *
	 * @var array
	 */
	protected $_referencedColumns;

	public function getReferencedColumns() {
		return $this->_referencedColumns;
	}

	/**
	 * ON DELETE
	 *
	 * @var array
	 */
	protected $_onDelete;

	public function getOnDelete() {
		return $this->_onDelete;
	}

	/**
	 * ON UPDATE
	 *
	 * @var array
	 */
	protected $_onUpdate;

	public function getOnUpdate() {
		return $this->_onUpdate;
	}



	/**
	 * Phalcon\Db\Reference constructor
	 * 
	 * @param string $name
	 * @param array $definition
	 */
	public function __construct($name, array $definition) {}

	/**
	 * Restore a Phalcon\Db\Reference object from export
	 * 
	 * @param array $data
	 *
	 * @return Reference
	 */
	public static function __set_state(array $data) {}

}
