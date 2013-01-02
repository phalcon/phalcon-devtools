<?php 

namespace Phalcon\Mvc\Model\MetaData {

	/**
	 * Phalcon\Mvc\Model\MetaData\Memory
	 *
	 * Stores model meta-data in memory. Data will be erased when the request finishes
	 *
	 */
	
	class Memory extends \Phalcon\Mvc\Model\MetaData {

		const MODELS_ATTRIBUTES = 0;

		const MODELS_PRIMARY_KEY = 1;

		const MODELS_NON_PRIMARY_KEY = 2;

		const MODELS_NOT_NULL = 3;

		const MODELS_DATA_TYPE = 4;

		const MODELS_DATA_TYPE_NUMERIC = 5;

		const MODELS_DATE_AT = 6;

		const MODELS_DATE_IN = 7;

		const MODELS_IDENTITY_FIELD = 8;

		protected $_changed;

		protected $_metaData;

		/**
		 * \Phalcon\Mvc\Model\MetaData constructor
		 *
		 * @param string $adapter
		 * @param array $options
		 */
		public function __construct($options){ }


		/**
		 * Reads the meta-data from temporal memory
		 *
		 * @return array
		 */
		public function read(){ }


		/**
		 * Writes the meta-data to temporal memory
		 *
		 * @param array $data
		 */
		public function write(){ }

	}
}
