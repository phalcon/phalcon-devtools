<?php 

namespace Phalcon\Http\Request {

	/**
	 * Phalcon\Http\Request\FileInterface initializer
	 */
	
	interface FileInterface {

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
		 * Returns the mime type reported by the browser
		 * This mime type is not completely secure, use getRealType() instead
		 *
		 * @return string
		 */
		public function getType();


		/**
		 * Gets the real mime type of the upload file using finfo
		 *
		 * @return string
		 */
		public function getRealType();


		/**
		 * Move the temporary file to a destination
		 *
		 * @param string $destination
		 * @return boolean
		 */
		public function moveTo($destination);

	}
}
