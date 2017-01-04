<?php

namespace Phalcon\Db\Adapter\Pdo;

use Phalcon\Db\Column;
use Phalcon\Db\AdapterInterface;
use Phalcon\Db\RawValue;
use Phalcon\Db\Adapter\Pdo as PdoAdapter;
use Phalcon\Db\Exception;


class Postgresql extends PdoAdapter implements AdapterInterface
{

	protected $_type = 'pgsql';

	protected $_dialectType = 'postgresql';



	/**
	 * This method is automatically called in Phalcon\Db\Adapter\Pdo constructor.
	 * Call it when you need to restore a database connection.
	 *
	 * @param $descriptor
	 * 
	 * @return void
	 */
	public function connect($descriptor=null) {}

	/**
	 * Returns an array of Phalcon\Db\Column objects describing a table
	 *
	 * <code>
	 * print_r($connection->describeColumns("posts"));
	 * </code>
	 * 
	 * @param string $table
	 * @param string $schema
	 *
	 * @return Column[]
	 */
	public function describeColumns($table, $schema=null) {}

	/**
		 * We're using FETCH_NUM to fetch the columns
		 * 0:name, 1:type, 2:size, 3:numericsize, 4: numericscale, 5: null, 6: key, 7: extra, 8: position, 9 default
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param array $definition
		 *
	 * @return boolean
	 */
	public function createTable($tableName, $schemaName, array $definition) {}

	/**
	 * Modifies a table column based on a definition
	 * 
	 * @param string $tableName
	 * @param string $schemaName
	 * @param \Phalcon\Db\ColumnInterface $column
	 * @param \Phalcon\Db\ColumnInterface $currentColumn
	 *
	 * @return boolean
	 */
	public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn=null) {}

	/**
	 * Check whether the database system requires an explicit value for identity columns
	 *
	 * @return boolean
	 */
	public function useExplicitIdValue() {}

	/**
	 * Returns the default identity value to be inserted in an identity column
	 *
	 *<code>
	 * //Inserting a new robot with a valid default value for the column 'id'
	 * $success = $connection->insert(
	 *     "robots",
	 *     array($connection->getDefaultIdValue(), "Astro Boy", 1952),
	 *     array("id", "name", "year")
	 * );
	 *</code>
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
