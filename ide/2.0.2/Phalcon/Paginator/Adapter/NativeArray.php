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
	
	class NativeArray extends \Phalcon\Paginator\Adapter implements \Phalcon\Paginator\AdapterInterface {

		protected $_config;

		/**
		 * \Phalcon\Paginator\Adapter\NativeArray constructor
		 */
		public function __construct($config){ }


		/**
		 * Returns a slice of the resultset to show in the pagination
		 */
		public function getPaginate(){ }

	}
}
