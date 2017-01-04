<?php

namespace Phalcon\Db\Adapter\Pdo;

use Phalcon\Db;
use Phalcon\Db\Column;
use Phalcon\Db\AdapterInterface;
use Phalcon\Db\Adapter\Pdo as PdoAdapter;


class Mysql extends PdoAdapter implements AdapterInterface
{

	protected $_type = 'mysql';

	protected $_dialectType = 'mysql';



	/**
	 * Escapes a column/table/schema name
	 *
	 * @param mixed $identifier
	 * 
	 * @return string
	 */
	public function escapeIdentifier($identifier) {}

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

}
