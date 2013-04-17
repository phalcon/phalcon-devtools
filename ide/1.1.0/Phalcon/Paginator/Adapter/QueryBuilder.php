<?php 

namespace Phalcon\Paginator\Adapter {

	/**
	 * Phalcon\Paginator\Adapter\QueryBuilder
	 *
	 * Component of pagination by array data
	 */
	
	class QueryBuilder implements \Phalcon\Paginator\AdapterInterface {

		protected $_config;

		protected $_builder;

		protected $_limitRows;

		protected $_page;

		/**
		 * \Phalcon\Paginator\Adapter\QueryBuilder
		 */
		public function __construct($config){ }


		public function setCurrentPage($currentPage){ }


		public function getPaginate(){ }

	}
}
