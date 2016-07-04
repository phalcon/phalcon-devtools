<?php

namespace Phalcon\Db;

/**
 * Phalcon\Db\Index
 * Allows to define indexes to be used on tables. Indexes are a common way
 * to enhance database performance. An index allows the database server to find
 * and retrieve specific rows much faster than it could do without an index
 */
class Index implements \Phalcon\Db\IndexInterface
{
    /**
     * Index name
     *
     * @var string
     */
    protected $_name;

    /**
     * Index columns
     *
     * @var array
     */
    protected $_columns;

    /**
     * Index type
     *
     * @var string
     */
    protected $_type;


    /**
     * Index name
     *
     * @return string 
     */
    public function getName() {}

    /**
     * Index columns
     *
     * @return array 
     */
    public function getColumns() {}

    /**
     * Index type
     *
     * @return string 
     */
    public function getType() {}

    /**
     * Phalcon\Db\Index constructor
     *
     * @param string $name 
     * @param array $columns 
     * @param mixed $type 
     */
    public function __construct($name, array $columns, $type = null) {}

    /**
     * Restore a Phalcon\Db\Index object from export
     *
     * @param array $data 
     * @return Index 
     */
    public static function __set_state(array $data) {}

}
