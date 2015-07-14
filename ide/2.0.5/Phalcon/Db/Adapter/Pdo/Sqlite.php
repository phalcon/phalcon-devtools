<?php

namespace Phalcon\Db\Adapter\Pdo;

use Phalcon\Db;
use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\RawValue;
use Phalcon\Db\Reference;
use Phalcon\Db\ReferenceInterface;
use Phalcon\Db\Index;
use Phalcon\Db\IndexInterface;
use Phalcon\Db\AdapterInterface;
use Phalcon\Db\Adapter\Pdo as PdoAdapter;


class Sqlite extends PdoAdapter implements AdapterInterface
{

	protected $_type = 'sqlite';

	protected $_dialectType = 'sqlite';



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
	 * 
	 * @param $table
	 * @param $schema
		 *
	 * @return IndexInterface[]
	 */
	public function describeIndexes($table, $schema=null) {}

	/**
	 * Lists table references
	 *
	 * @param string $table
	 * @param string $schema
	 * 
	 * @return ReferenceInterface[]
	 */
	public function describeReferences($table, $schema=null) {}

	/**
	 * Check whether the database system requires an explicit value for identity columns
	 *
	 * @return boolean
	 */
	public function useExplicitIdValue() {}

	/**
	 * Returns the default value to make the RBDM use the default value declared in the table definition
	 *
	 *<code>
	 * //Inserting a new robot with a valid default value for the column 'year'
	 * $success = $connection->insert(
	 *	 "robots",
	 *	 array("Astro Boy", $connection->getDefaultValue()),
	 *	 array("name", "year")
	 * );
	 *</code>
	 *
	 * @return RawValue
	 */
	public function getDefaultValue() {}

}
