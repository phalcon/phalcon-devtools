<?php 

namespace Phalcon\Db {

    /**
     * Phalcon\Db\Reference
     *
     * Allows to define reference constraints on tables
     *
     *<code>
     *	$reference = new \Phalcon\Db\Reference("field_fk", array(
     *		'referencedSchema' => "invoicing",
     *		'referencedTable' => "products",
     *		'columns' => array("product_type", "product_code"),
     *		'referencedColumns' => array("type", "code")
     *	));
     *</code>
     */
    class Reference implements \Phalcon\Db\ReferenceInterface
    {

        protected $_schemaName;

        protected $_referencedSchema;

        protected $_referenceName;

        protected $_referencedTable;

        protected $_columns;

        protected $_referencedColumns;

        /**
         * \Phalcon\Db\Reference constructor
         *
         * @param string name
         * @param array definition
         */
        public function __construct($referenceName, $definition)
        {
        }


        /**
         * Constraint name
         *
         * @var string
         */
        public function getName()
        {
        }


        public function getSchemaName()
        {
        }


        public function getReferencedSchema()
        {
        }


        /**
         * Local reference columns
         *
         * @var array
         */
        public function getColumns()
        {
        }


        /**
         * Referenced Table
         *
         * @var string
         */
        public function getReferencedTable()
        {
        }


        /**
         * Referenced Columns
         *
         * @var array
         */
        public function getReferencedColumns()
        {
        }


        /**
         * Restore a \Phalcon\Db\Reference object from export
         *
         * @param array data
         * @return \Phalcon\Db\Reference
         */
        public static function __set_state($properties=null)
        {
        }

    }
}
