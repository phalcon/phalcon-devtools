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
		 * Returns a slice of the resultset to show in the pagination
		 *
		 * @return stdClass
		 */
		public function getPaginate(){ }


		/**
		 * Set current rows limit
		 *
		 * @param int $limit
		 *
		 * @return \Phalcon\Paginator\Adapter\QueryBuilder $this Fluent interface
		 */
		public function setLimit($limit){ }


		/**
		 * Get current rows limit
		 *
		 * @return int $limit
		 */
		public function getLimit(){ }


		/**
		 * Set current page number
		 *
		 * @param int $page
		 */
		public function setCurrentPage($page){ }


		/**
		 * Get current page number
		 *
		 * @param int $page
		 */
		public function getCurrentPage(){ }


		/**
		 * Set query builder object
		 *
		 * @param \Phalcon\Mvc\Model\Query\BuilderInterface $builder
		 *
		 * @return \Phalcon\Paginator\Adapter\QueryBuilder $this Fluent interface
		 */
		public function setQueryBuilder($queryBuilder){ }


		/**
		 * Get query builder object
		 *
		 * @return \Phalcon\Mvc\Model\Query\BuilderInterface $builder
		 */
		public function getQueryBuilder(){ }

	}
}
