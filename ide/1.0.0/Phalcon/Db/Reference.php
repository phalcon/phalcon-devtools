<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Reference
	 *
	 * Allows to define reference constraints on tables
	 *
	 *<code>
	 *	$reference = new Phalcon\Db\Reference("field_fk", array(
	 *		'referencedSchema' => "invoicing",
	 *		'referencedTable' => "products",
	 *		'columns' => array("product_type", "product_code"),
	 *		'referencedColumns' => array("type", "code")
	 *	));
	 *</code>
	 */
	
	class Reference implements \Phalcon\Db\ReferenceInterface {

		protected $_schemaName;

		protected $_referencedSchema;

		protected $_referenceName;

		protected $_referencedTable;

		protected $_columns;

		protected $_referencedColumns;

		/**
		 * \Phalcon\Db\Reference constructor
		 *
		 * @param string $referenceName
		 * @param array $definition
		 */
		public function __construct($referenceName, $definition){ }


		/**
		 * Gets the index name
		 *
		 * @return string
		 */
		public function getName(){ }


		/**
		 * Gets the schema where referenced table is
		 *
		 * @return string
		 */
		public function getSchemaName(){ }


		/**
		 * Gets the schema where referenced table is
		 *
		 * @return string
		 */
		public function getReferencedSchema(){ }


		/**
		 * Gets local columns which reference is based
		 *
		 * @return array
		 */
		public function getColumns(){ }


		/**
		 * Gets the referenced table
		 *
		 * @return string
		 */
		public function getReferencedTable(){ }


		/**
		 * Gets referenced columns
		 *
		 * @return array
		 */
		public function getReferencedColumns(){ }


		/**
		 * Restore a \Phalcon\Db\Reference object from export
		 *
		 * @param array $data
		 * @return \Phalcon\Db\Reference
		 */
		public static function __set_state($data){ }

	}
}
