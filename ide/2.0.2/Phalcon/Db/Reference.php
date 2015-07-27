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
	
	class Reference implements \Phalcon\Db\ReferenceInterface {

		protected $_name;

		protected $_schemaName;

		protected $_referencedSchema;

		protected $_referencedTable;

		protected $_columns;

		protected $_referencedColumns;

		protected $_onDelete;

		protected $_onUpdate;

		/**
		 * Constraint name
		 *
		 * @var string
		 */
		public function getName(){ }


		public function getSchemaName(){ }


		public function getReferencedSchema(){ }


		/**
		 * Referenced Table
		 *
		 * @var string
		 */
		public function getReferencedTable(){ }


		/**
		 * Local reference columns
		 *
		 * @var array
		 */
		public function getColumns(){ }


		/**
		 * Referenced Columns
		 *
		 * @var array
		 */
		public function getReferencedColumns(){ }


		/**
		 * ON DELETE
		 *
		 * @var array
		 */
		public function getOnDelete(){ }


		/**
		 * ON UPDATE
		 *
		 * @var array
		 */
		public function getOnUpdate(){ }


		/**
		 * \Phalcon\Db\Reference constructor
		 */
		public function __construct($name, $definition){ }


		/**
		 * Restore a \Phalcon\Db\Reference object from export
		 */
		public static function __set_state($data){ }

	}
}
