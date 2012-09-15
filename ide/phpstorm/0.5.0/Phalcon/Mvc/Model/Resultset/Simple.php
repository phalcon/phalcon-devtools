<?php 

namespace Phalcon\Mvc\Model\Resultset {

	/**
	 * Phalcon\Mvc\Model\Resultset\Simple
	 *
	 * Simple resultsets only contains a complete object.
	 * This class builds every complete object as it's required
	 *
	 */
	
	class Simple extends \Phalcon\Mvc\Model\Resultset {

		protected $_type;

		protected $_result;

		protected $_cache;

		protected $_isFresh;

		protected $_pointer;

		protected $_count;

		protected $_activeRow;

		protected $_rows;

		protected $_model;

		/**
		 * \Phalcon\Mvc\Model\Resultset\Simple constructor
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @param \Phalcon\Db\Result\Pdo $result
		 * @param \Phalcon\Cache\Backend $cache
		 */
		public function __construct($model, $result, $cache){ }


		/**
		 * Check whether internal resource has rows to fetch
		 *
		 * @return boolean
		 */
		public function valid(){ }


		/**
		 * Serializing a resultset will dump all related rows into a big array
		 *
		 * @return string
		 */
		public function serialize(){ }


		/**
		 * Unserializing a resultset will allow to only works on the rows present in the saved state
		 *
		 * @param string $data
		 */
		public function unserialize($data){ }

	}
}
