<?php

namespace Phalcon\Db\Adapter\Pdo;

class Sqlite extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface
{

    protected $_type = "sqlite";


    protected $_dialectType = "sqlite";


    /**
     * This method is automatically called in Phalcon\Db\Adapter\Pdo constructor.
     * Call it when you need to restore a database connection.
     *
     * @param mixed $descriptor 
     * @param array $$descriptor 
     * @return boolean 
     */
	public function connect($descriptor = null) {}

    /**
     * Returns an array of Phalcon\Db\Column objects describing a table
     * <code>
     * print_r($connection->describeColumns("posts"));
     * </code>
     *
     * @param string $table 
     * @param string $schema 
     * @return \Phalcon\Db\Column[] 
     */
	public function describeColumns($table, $schema = null) {}

    /**
     * Lists table indexes
     *
     * @param	string table
     * @param	string schema
     * @return	Phalcon\Db\IndexInterface[]
     * @param mixed $table 
     * @param mixed $schema 
     * @return \Phalcon\Db\IndexInterface 
     */
	public function describeIndexes($table, $schema = null) {}

    /**
     * Lists table references
     *
     * @param	string table
     * @param	string schema
     * @return	Phalcon\Db\ReferenceInterface[]
     * @param mixed $table 
     * @param mixed $schema 
     * @return \Phalcon\Db\ReferenceInterface 
     */
	public function describeReferences($table, $schema = null) {}

    /**
     * Check whether the database system requires an explicit value for identity columns
     *
     * @return bool 
     */
	public function useExplicitIdValue() {}

}
