<?php 

namespace Phalcon\Http\Request {

	/**
	 * Phalcon\Http\Request\FileInterface initializer
	 */
	
	interface FileInterface {

		/**
		 * \Phalcon\Http\Request\FileInterface constructor
		 *
		 * @param array $file
		 */
		public function __construct($file);


		/**
		 * Returns the file size of the uploaded file
		 *
		 * @return int
		 */
		public function getSize();


		/**
		 * Returns the real name of the uploaded file
		 *
		 * @return string
		 */
		public function getName();


		/**
		 * Returns the temporal name of the uploaded file
		 *
		 * @return string
		 */
		public function getTempName();


		/**
		 * Move the temporary file to a destination
		 *
		 * @param string $destination
		 * @return boolean
		 */
		public function moveTo($destination);

	}
}
