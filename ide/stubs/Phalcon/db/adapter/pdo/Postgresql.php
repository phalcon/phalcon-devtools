<?php

namespace Phalcon\Db\Adapter\Pdo;

/**
 * Phalcon\Db\Adapter\Pdo\Postgresql
 * Specific functions for the Postgresql database system
 * <code>
 * use Phalcon\Db\Adapter\Pdo\Postgresql;
 * $config = [
 * 'host'     => 'localhost',
 * 'dbname'   => 'blog',
 * 'port'     => 5432,
 * 'username' => 'postgres',
 * 'password' => 'secret'
 * ];
 * $connection = new Postgresql($config);
 * </code>
 */
class Postgresql extends \Phalcon\Db\Adapter\Pdo implements \Phalcon\Db\AdapterInterface
{

    protected $_type = "pgsql";


    protected $_dialectType = "postgresql";


    /**
     * This method is automatically called in Phalcon\Db\Adapter\Pdo constructor.
     * Call it when you need to restore a database connection.
     *
     * @param array $descriptor 
     * @return bool 
     */
    public function connect(array $descriptor = null) {}

    /**
     * Returns an array of Phalcon\Db\Column objects describing a table
     * <code>
     * print_r($connection->describeColumns("posts"));
     * </code>
     *
     * @param string $table 
     * @param string $schema 
     * @return Column[] 
     */
    public function describeColumns($table, $schema = null) {}

    /**
     * Creates a table
     *
     * @param string $tableName 
     * @param string $schemaName 
     * @param array $definition 
     * @return bool 
     */
    public function createTable($tableName, $schemaName, array $definition) {}

    /**
     * Modifies a table column based on a definition
     *
     * @param string $tableName 
     * @param string $schemaName 
     * @param mixed $column 
     * @param mixed $currentColumn 
     * @return bool 
     */
    public function modifyColumn($tableName, $schemaName, \Phalcon\Db\ColumnInterface $column, \Phalcon\Db\ColumnInterface $currentColumn = null) {}

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
