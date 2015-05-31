<?php 

namespace Phalcon\Db {

	interface ResultInterface {

		public function __construct(\Phalcon\Db\AdapterInterface $connection, \PDOStatement $result, $sqlStatement=null, $bindParams=null, $bindTypes=null);


		public function execute();


		public function fetch();


		public function fetchArray();


		public function fetchAll();


		public function numRows();


		public function dataSeek($number);


		public function setFetchMode($fetchMode);


		public function getInternalResult();

	}
}
