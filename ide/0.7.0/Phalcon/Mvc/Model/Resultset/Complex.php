<?php 

namespace Phalcon\Mvc\Model\Resultset {

	/**
	 * Phalcon\Mvc\Model\Resultset\Complex
	 *
	 * Complex resultsets may include complete objects and scalar values.
	 * This class builds every complex row as the're required
	 */
	
	class Complex extends \Phalcon\Mvc\Model\Resultset {

		protected $_columnTypes;

		/**
		 * \Phalcon\Mvc\Model\Resultset\Complex constructor
		 *
		 * @param array $columnsTypes
		 * @param \Phalcon\Db\ResultInterface $result
		 * @param \Phalcon\Cache\BackendInterface $cache
		 */
		public function __construct($columnsTypes, $result, $cache=null){ }


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
