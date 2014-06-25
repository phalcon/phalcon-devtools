<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Column
	 *
	 * Allows to define columns to be used on create or alter table operations
	 *
	 *<code>
	 *	use Phalcon\Db\Column as Column;
	 *
	 * //column definition
	 * $column = new Column("id", array(
	 *   "type" => Column::TYPE_INTEGER,
	 *   "size" => 10,
	 *   "unsigned" => true,
	 *   "notNull" => true,
	 *   "autoIncrement" => true,
	 *   "first" => true
	 * ));
	 *
	 * //add column to existing table
	 * $connection->addColumn("robots", null, $column);
	 *</code>
	 *
	 */
	
	class Column implements \Phalcon\Db\ColumnInterface {

		const TYPE_INTEGER = 0;

		const TYPE_DATE = 1;

		const TYPE_VARCHAR = 2;

		const TYPE_DECIMAL = 3;

		const TYPE_DATETIME = 4;

		const TYPE_CHAR = 5;

		const TYPE_TEXT = 6;

		const TYPE_FLOAT = 7;

		const TYPE_BOOLEAN = 8;

		const TYPE_DOUBLE = 9;

		const BIND_PARAM_NULL = 0;

		const BIND_PARAM_INT = 1;

		const BIND_PARAM_STR = 2;

		const BIND_PARAM_BOOL = 5;

		const BIND_PARAM_DECIMAL = 32;

		const BIND_SKIP = 1024;

		protected $_columnName;

		protected $_schemaName;

		protected $_type;

		protected $_isNumeric;

		protected $_size;

		protected $_scale;

		protected $_unsigned;

		protected $_notNull;

		protected $_primary;

		protected $_autoIncrement;

		protected $_first;

		protected $_after;

		protected $_bindType;

		/**
		 * \Phalcon\Db\Column constructor
		 *
		 * @param string $columnName
		 * @param array $definition
		 */
		public function __construct($columnName, $definition){ }


		/**
		 * Returns schema's table related to column
		 *
		 * @return string
		 */
		public function getSchemaName(){ }


		/**
		 * Returns column name
		 *
		 * @return string
		 */
		public function getName(){ }


		/**
		 * Returns column type
		 *
		 * @return int
		 */
		public function getType(){ }


		/**
		 * Returns column size
		 *
		 * @return int
		 */
		public function getSize(){ }


		/**
		 * Returns column scale
		 *
		 * @return int
		 */
		public function getScale(){ }


		/**
		 * Returns true if number column is unsigned
		 *
		 * @return boolean
		 */
		public function isUnsigned(){ }


		/**
		 * Not null
		 *
		 * @return boolean
		 */
		public function isNotNull(){ }


		/**
		 * Column is part of the primary key?
		 *
		 * @return boolean
		 */
		public function isPrimary(){ }


		/**
		 * Auto-Increment
		 *
		 * @return boolean
		 */
		public function isAutoIncrement(){ }


		/**
		 * Check whether column have an numeric type
		 *
		 * @return boolean
		 */
		public function isNumeric(){ }


		/**
		 * Check whether column have first position in table
		 *
		 * @return boolean
		 */
		public function isFirst(){ }


		/**
		 * Check whether field absolute to position in table
		 *
		 * @return string
		 */
		public function getAfterPosition(){ }


		/**
		 * Returns the type of bind handling
		 *
		 * @return int
		 */
		public function getBindType(){ }


		/**
		 * Restores the internal state of a \Phalcon\Db\Column object
		 *
		 * @param array $data
		 * @return \Phalcon\Db\Column
		 */
		public static function __set_state($properties=null){ }

	}
}
