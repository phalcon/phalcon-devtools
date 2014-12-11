<?php 

namespace Phalcon\Paginator\Adapter {

	/**
	 * Phalcon\Paginator\Adapter\Model
	 *
	 * This adapter allows to paginate data using a Phalcon\Mvc\Model resultset as base
	 */
	
	class Model implements \Phalcon\Paginator\AdapterInterface {

		protected $_limitRows;

		protected $_config;

		protected $_page;

		/**
		 * \Phalcon\Paginator\Adapter\Model constructor
		 *
		 * @param array $config
		 */
		public function __construct($config){ }


		/**
		 * Set the current page number
		 *
		 * @param int $page
		 */
		public function setCurrentPage($page){ }


		/**
		 * Returns a slice of the resultset to show in the pagination
		 *
		 * @return stdClass
		 */
		public function getPaginate(){ }

	}
}
