<?php 

namespace Phalcon\Db {

	interface IndexInterface {

		public function __construct($indexName, $columns, $type=null);


		public function getName();


		public function getColumns();


		public function getType();


		public static function __set_state($data);

	}
}
