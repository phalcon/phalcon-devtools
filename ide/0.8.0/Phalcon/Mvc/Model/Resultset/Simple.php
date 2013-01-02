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

		protected $_model;

		protected $_columnMap;

		/**
		 * \Phalcon\Mvc\Model\Resultset\Simple constructor
		 *
		 * @param array $columnMap
		 * @param \Phalcon\Mvc\Model $model
		 * @param \Phalcon\Db\Result\Pdo $result
		 * @param \Phalcon\Cache\Backend $cache
		 */
		public function __construct($columnMap, $model, $result, $cache=null){ }


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
