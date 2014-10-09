<?php 

namespace Phalcon\Paginator\Adapter {

	/**
	 * Phalcon\Paginator\Adapter\NativeArray
	 *
	 * Pagination using a PHP array as source of data
	 *
	 *<code>
	 *	$paginator = new \Phalcon\Paginator\Adapter\Model(
	 *		array(
	 *			"data"  => array(
	 *				array('id' => 1, 'name' => 'Artichoke'),
	 *				array('id' => 2, 'name' => 'Carrots'),
	 *				array('id' => 3, 'name' => 'Beet'),
	 *				array('id' => 4, 'name' => 'Lettuce'),
	 *				array('id' => 5, 'name' => '')
	 *			),
	 *			"limit" => 2,
	 *			"page"  => $currentPage
	 *		)
	 *	);
	 *</code>
	 *
	 */
	
	class NativeArray implements \Phalcon\Paginator\AdapterInterface {

		protected $_limitRows;

		protected $_data;

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
