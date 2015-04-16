<?php

namespace Phalcon\Db;

class Reference implements \Phalcon\Db\ReferenceInterface
{
    /**
     * Constraint name
     *
     * @var string
     */
    protected $_name;


    protected $_schemaName;


    protected $_referencedSchema;

    /**
     * Referenced Table
     *
     * @var string
     */
    protected $_referencedTable;

    /**
     * Local reference columns
     *
     * @var array
     */
    protected $_columns;

    /**
     * Referenced Columns
     *
     * @var array
     */
    protected $_referencedColumns;

    /**
     * ON DELETE
     *
     * @var array
     */
    protected $_onDelete;

    /**
     * ON UPDATE
     *
     * @var array
     */
    protected $_onUpdate;


    /**
     * Constraint name
     *
     * @return string 
     */
	public function getName() {}


	public function getSchemaName() {}


	public function getReferencedSchema() {}

    /**
     * Referenced Table
     *
     * @return string 
     */
	public function getReferencedTable() {}

    /**
     * Local reference columns
     *
     * @return array 
     */
	public function getColumns() {}

    /**
     * Referenced Columns
     *
     * @return array 
     */
	public function getReferencedColumns() {}

    /**
     * ON DELETE
     *
     * @return array 
     */
	public function getOnDelete() {}

    /**
     * ON UPDATE
     *
     * @return array 
     */
	public function getOnUpdate() {}

    /**
     * Phalcon\Db\Reference constructor
     *
     * @param string $name 
     * @param array $definition 
     */
	public function __construct($name, $definition) {}

    /**
     * Restore a Phalcon\Db\Reference object from export
     *
     * @param array $data 
     * @return Reference 
     */
	public static function __set_state($data) {}

}
