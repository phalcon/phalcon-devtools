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

		const BIND_PARAM_NULL = 0;

		const BIND_PARAM_INT = 1;

		const BIND_PARAM_STR = 2;

		const BIND_PARAM_BOOL = 5;

		const BIND_PARAM_DECIMAL = 32;

		const BIND_SKIP = 1024;

		protected $_name;

		protected $_schemaName;

		protected $_type;

		protected $_typeReference;

		protected $_typeValues;

		protected $_isNumeric;

		protected $_size;

		protected $_scale;

		protected $_default;

		protected $_unsigned;

		protected $_notNull;

		protected $_primary;

		protected $_autoIncrement;

		protected $_first;

		protected $_after;

		protected $_bindType;

		/**
		 * Column's name
		 *
		 * @var string
		 */
		public function getName(){ }


		/**
		 * Schema which table related is
		 *
		 * @var string
		 */
		public function getSchemaName(){ }


		/**
		 * Column data type
		 *
		 * @var int|string
		 */
		public function getType(){ }


		/**
		 * Column data type reference
		 *
		 * @var int
		 */
		public function getTypeReference(){ }


		/**
		 * Column data type values
		 *
		 * @var array|string
		 */
		public function getTypeValues(){ }


		/**
		 * Integer column size
		 *
		 * @var int
		 */
		public function getSize(){ }


		/**
		 * Integer column number scale
		 *
		 * @var int
		 */
		public function getScale(){ }


		/**
		 * Default column value
		 */
		public function getDefault(){ }


		/**
		 * \Phalcon\Db\Column constructor
		 */
		public function __construct($name, $definition){ }


		/**
		 * Returns true if number column is unsigned
		 */
		public function isUnsigned(){ }


		/**
		 * Not null
		 */
		public function isNotNull(){ }


		/**
		 * Column is part of the primary key?
		 */
		public function isPrimary(){ }


		/**
		 * Auto-Increment
		 */
		public function isAutoIncrement(){ }


		/**
		 * Check whether column have an numeric type
		 */
		public function isNumeric(){ }


		/**
		 * Check whether column have first position in table
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
		 */
		public function getBindType(){ }


		/**
		 * Restores the internal state of a \Phalcon\Db\Column object
		 */
		public static function __set_state($data){ }

	}
}
