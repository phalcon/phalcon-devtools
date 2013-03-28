<?php 

namespace Phalcon\Annotations\Adapter {

	/**
	 * Phalcon\Annotations\Adapter\Files
	 *
	 * Stores the parsed annotations in diles. This adapter is the suitable for production
	 *
	 *<code>
	 * $annotations = new \Phalcon\Annotations\Adapter\Files(array(
	 *    'metaDataDir' => 'app/cache/metadata/'
	 * ));
	 *</code>
	 */
	
	class Files extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface {

		protected $_annotationsDir;

		/**
		 * \Phalcon\Annotations\Adapter\Files constructor
		 *
		 * @param array $options
		 */
		public function __construct($options=null){ }


		/**
		 * Reads parsed annotations from files
		 *
		 * @param string $key
		 * @return array
		 */
		public function read($key){ }


		/**
		 * Writes parsed annotations to files
		 *
		 * @param string $key
		 * @param array $data
		 */
		public function write($key, $data){ }

	}
}
