<?php 

namespace Phalcon\Db {

	interface ColumnInterface {

		public function __construct($columnName, $definition);


		public function getSchemaName();


		public function getName();


		public function getType();


		public function getTypeReference();


		public function getTypeValues();


		public function getSize();


		public function getScale();


		public function isUnsigned();


		public function isNotNull();


		public function isPrimary();


		public function isAutoIncrement();


		public function isNumeric();


		public function isFirst();


		public function getAfterPosition();


		public function getBindType();


		public function getDefault();


		public static function __set_state($data);

	}
}
