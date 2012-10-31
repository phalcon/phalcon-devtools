<?php 

namespace Phalcon\Mvc\Model\MetaData {

	/**
	 * Phalcon\Mvc\Model\MetaData\Files
	 *
	 * Stores model meta-data in PHP files.
	 *
	 *<code>
	 * $metaData = new Phalcon\Mvc\Model\Metadata\Files(array(
	 *    'metaDataDir' => 'app/cache/metadata/'
	 * ));
	 *</code>
	 */
	
	class Files extends \Phalcon\Mvc\Model\MetaData {

		const MODELS_ATTRIBUTES = 0;

		const MODELS_PRIMARY_KEY = 1;

		const MODELS_NON_PRIMARY_KEY = 2;

		const MODELS_NOT_NULL = 3;

		const MODELS_DATA_TYPES = 4;

		const MODELS_DATA_TYPES_NUMERIC = 5;

		const MODELS_DATE_AT = 6;

		const MODELS_DATE_IN = 7;

		const MODELS_IDENTITY_COLUMN = 8;

		const MODELS_DATA_TYPES_BIND = 9;

		const MODELS_AUTOMATIC_DEFAULT_INSERT = 10;

		const MODELS_AUTOMATIC_DEFAULT_UPDATE = 11;

		protected $_metaDataDir;

		/**
		 * \Phalcon\Mvc\Model\MetaData\Files constructor
		 *
		 * @param array $options
		 */
		public function __construct($options=null){ }


		/**
		 * Reads meta-data from $_SESSION
		 *
		 * @return array
		 */
		public function read($key){ }


		/**
		 * Writes the meta-data to $_SESSION
		 *
		 * @param string $key
		 * @param array $data
		 */
		public function write($key, $data){ }

	}
}
