<?php 

namespace Phalcon\Mvc\Model\MetaData {

	/**
	 * Phalcon\Mvc\Model\MetaData\Session
	 *
	 * Stores model meta-data in session. Data will erase when the session finishes.
	 * Meta-data are permanent while the session is active.
	 *
	 * You can query the meta-data by printing $_SESSION['$PMM$']
	 *
	 *<code>
	 * $metaData = new Phalcon\Mvc\Model\Metadata\Session(array(
	 *    'suffix' => 'my-app-id'
	 * ));
	 *</code>
	 */
	
	class Session extends \Phalcon\Mvc\Model\MetaData {

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

		protected $_suffix;

		/**
		 * \Phalcon\Mvc\Model\MetaData\Session constructor
		 *
		 * @param array $options
		 */
		public function __construct($options){ }


		/**
		 * Reads meta-data from $_SESSION
		 *
		 * @return array
		 */
		public function read(){ }


		/**
		 * Writes the meta-data to $_SESSION
		 *
		 * @param array $data
		 */
		public function write($data){ }

	}
}
