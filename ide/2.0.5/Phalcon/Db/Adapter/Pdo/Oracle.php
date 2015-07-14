<?php

namespace Phalcon\Db\Adapter\Pdo;

use Phalcon\Db\Column;
use Phalcon\Db\RawValue;
use Phalcon\Db\AdapterInterface;
use Phalcon\Db\Adapter\Pdo as PdoAdapter;


class Oracle extends PdoAdapter implements AdapterInterface
{

	protected $_type = 'oci';

	protected $_dialectType = 'oracle';



	/**
	 * This method is automatically called in Phalcon\Db\Adapter\Pdo constructor.
	 * Call it when you need to restore a database connection.
	 *
	 * @param array $descriptor
	 * 
	 * @return boolean
	 */
	public function connect($descriptor=null) {}

	/**
		 * Database session settings initiated with each HTTP request. Oracle behaviour depends on particular NLS* parameter. Check if the developer has defined custom startup or create one from scratch
	 * 
	 * @param string $table
	 * @param string $schema
		 *
	 * @return Column[]
	 */
	public function describeColumns($table, $schema=null) {}

	/**
		 *  0:column_name, 1:data_type, 2:data_length, 3:data_precision, 4:data_scale, 5:nullable, 6:constraint_type, 7:default, 8:position;
	 * 
	 * @param string $sequenceName
		 *
	 * @return int
	 */
	public function lastInsertId($sequenceName=null) {}

	/**
	 * Check whether the database system requires an explicit value for identity columns
	 *
	 * @return boolean
	 */
	public function useExplicitIdValue() {}

	/**
	 * Return the default identity value to insert in an identity column
	 *
	 * @return RawValue
	 */
	public function getDefaultIdValue() {}

	/**
	 * Check whether the database system requires a sequence to produce auto-numeric values
	 *
	 * @return boolean
	 */
	public function supportSequences() {}

}
