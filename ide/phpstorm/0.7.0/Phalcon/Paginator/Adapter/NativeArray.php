<?php 

namespace Phalcon\Paginator\Adapter {

	/**
	 * Phalcon\Paginator\Adapter\NativeArray
	 *
	 * Component of pagination by array data
	 *
	 */
	
	class NativeArray {

		protected $_limitRows;

		protected $_config;

		protected $_page;

		/**
		 * \Phalcon\Paginator\Adapter\NativeArray constructor
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
