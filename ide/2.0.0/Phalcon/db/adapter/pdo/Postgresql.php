<?php

namespace Phalcon\Db\Adapter\Pdo;

class Postgresql extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface
{

    protected $_type = "pgsql";


    protected $_dialectType = "postgresql";


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
     * Check whether the database system requires an explicit value for identity columns
     *
     * @return bool 
     */
	public function useExplicitIdValue() {}

    /**
     * Returns the default identity value to be inserted in an identity column
     * <code>
     * //Inserting a new robot with a valid default value for the column 'id'
     * $success = $connection->insert(
     * "robots",
     * array($connection->getDefaultIdValue(), "Astro Boy", 1952),
     * array("id", "name", "year")
     * );
     * </code>
     *
     * @return \Phalcon\Db\RawValue 
     */
	public function getDefaultIdValue() {}

    /**
     * Check whether the database system requires a sequence to produce auto-numeric values
     *
     * @return bool 
     */
	public function supportSequences() {}

}
