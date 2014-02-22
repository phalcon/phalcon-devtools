<?php 

namespace Phalcon\Mvc\Model\Resultset {

	/**
	 * Phalcon\Mvc\Model\Resultset\Simple
	 *
	 * Simple resultsets only contains complete objects.
	 * This class builds every complete object as it is required
	 */
	
	class Simple extends \Phalcon\Mvc\Model\Resultset implements \Serializable, \ArrayAccess, \Countable, \SeekableIterator, \Traversable, \Iterator, \Phalcon\Mvc\Model\ResultsetInterface {

		const TYPE_RESULT_FULL = 0;

		const TYPE_RESULT_PARTIAL = 1;

		const HYDRATE_RECORDS = 0;

		const HYDRATE_OBJECTS = 2;

		const HYDRATE_ARRAYS = 1;

		protected $_model;

		protected $_columnMap;

		protected $_keepSnapshots;

		/**
		 * \Phalcon\Mvc\Model\Resultset\Simple constructor
		 *
		 * @param array $columnMap
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param \Phalcon\Db\Result\Pdo $result
		 * @param \Phalcon\Cache\BackendInterface $cache
		 * @param boolean $keepSnapshots
		 */
		public function __construct($columnMap, $model, $result, $cache=null, $keepSnapshots=null){ }


		/**
		 * Check whether the internal resource has rows to fetch
		 *
		 * @return boolean
		 */
		public function valid(){ }


		/**
		 * Returns a complete resultset as an array, if the resultset has a big number of rows
		 * it could consume more memory than it currently does. Exporting the resultset to an array
		 * couldn't be faster with a large number of records
		 *
		 * @param boolean $renameColumns
		 * @return array
		 */
		public function toArray($renameColumns=null){ }


		/**
		 * Serializing a resultset will dump all related rows into a big array
		 *
		 * @return string
		 */
		public function serialize(){ }


		/**
		 * Unserializing a resultset only works on the rows present in the saved state
		 *
		 * @param string $data
		 */
		public function unserialize($data){ }

	}
}
