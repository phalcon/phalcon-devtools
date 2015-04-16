<?php

namespace Phalcon\Db\Adapter\Pdo;

class Oracle extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface
{

    protected $_type = "oci";


    protected $_dialectType = "oracle";


    /**
     * This method is automatically called in Phalcon\Db\Adapter\Pdo constructor.
     * Call it when you need to restore a database connection.
     *
     * @param array $descriptor 
     * @return boolean 
     */
	public function connect($descriptor = null) {}

    /**
     * Returns an array of Phalcon\Db\Column objects describing a table
     * <code>print_r($connection->describeColumns("posts")); ?></code>
     *
     * @param string $table 
     * @param string $schema 
     * @return \Phalcon\Db\Column[] 
     */
	public function describeColumns($table, $schema = null) {}

    /**
     * Returns the insert id for the auto_increment/serial column inserted in the lastest executed SQL statement
     * <code>
     * //Inserting a new robot
     * $success = $connection->insert(
     * "robots",
     * array("Astro Boy", 1952),
     * array("name", "year")
     * );
     * //Getting the generated id
     * $id = $connection->lastInsertId();
     * </code>
     *
     * @param string $sequenceName 
     * @return int 
     */
	public function lastInsertId($sequenceName = null) {}

    /**
     * Check whether the database system requires an explicit value for identity columns
     *
     * @return bool 
     */
	public function useExplicitIdValue() {}

    /**
     * Return the default identity value to insert in an identity column
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
