<?php

namespace Phalcon\Db;

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
	public function __construct($name, $columns, $type = null) {}

    /**
     * Restore a Phalcon\Db\Index object from export
     *
     * @param array $data 
     * @return Index 
     */
	public static function __set_state($data) {}

}
