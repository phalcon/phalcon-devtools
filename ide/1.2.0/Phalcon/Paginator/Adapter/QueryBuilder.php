<?php 

namespace Phalcon\Paginator\Adapter {

	/**
	 * Phalcon\Paginator\Adapter\QueryBuilder
	 *
	 * Pagination using a PHQL query builder as source of data
	 *
	 *<code>
	 *  $builder = $this->modelsManager->createBuilder()
	 *                   ->columns('id, name')
	 *                   ->from('Robots')
	 *                   ->orderBy('name');
	 *
	 *  $paginator = new Phalcon\Paginator\Adapter\QueryBuilder(array(
	 *      "builder" => $builder,
	 *      "limit"=> 20,
	 *      "page" => 1
	 *  ));
	 *</code>
	 */
	
	class QueryBuilder implements \Phalcon\Paginator\AdapterInterface {

		protected $_config;

		protected $_builder;

		protected $_limitRows;

		protected $_page;

		/**
		 * \Phalcon\Paginator\Adapter\QueryBuilder
		 *
		 * @param array $config
		 */
		public function __construct($config){ }


		/**
		 * Set the current page number
		 *
		 * @param int $page
		 */
		public function setCurrentPage($currentPage){ }


		/**
		 * Returns a slice of the resultset to show in the pagination
		 *
		 * @return stdClass
		 */
		public function getPaginate(){ }

	}
}
