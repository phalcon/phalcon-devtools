<?php 

namespace Phalcon\Http\Request {

	/**
	 * Phalcon\Http\Request\File
	 *
	 * Provides OO wrappers to the $_FILES superglobal
	 *
	 *<code>
	 *	class PostsController extends \Phalcon\Mvc\Controller
	 *	{
	 *
	 *		public function uploadAction()
	 *		{
	 *			//Check if the user has uploaded files
	 *			if ($this->request->hasFiles() == true) {
	 *				//Print the real file names and their sizes
	 *				foreach ($this->request->getUploadedFiles() as $file){
	 *					echo $file->getName(), " ", $file->getSize(), "\n";
	 *				}
	 *			}
	 *		}
	 *
	 *	}
	 *</code>
	 */
	
	class File implements \Phalcon\Http\Request\FileInterface {

		protected $_name;

		protected $_tmp;

		protected $_size;

		protected $_type;

		protected $_error;

		protected $_key;

		/**
		 * \Phalcon\Http\Request\File constructor
		 *
		 * @param array $file
		 */
		public function __construct($file, $key=null){ }


		/**
		 * Returns the file size of the uploaded file
		 *
		 * @return int
		 */
		public function getSize(){ }


		/**
		 * Returns the real name of the uploaded file
		 *
		 * @return string
		 */
		public function getName(){ }


		/**
		 * Returns the temporal name of the uploaded file
		 *
		 * @return string
		 */
		public function getTempName(){ }


		/**
		 * Returns the mime type reported by the browser
		 * This mime type is not completely secure, use getRealType() instead
		 *
		 * @return string
		 */
		public function getType(){ }


		/**
		 * Gets the real mime type of the upload file using finfo
		 *
		 * @todo Not implemented
		 * @return string
		 */
		public function getRealType(){ }


		/**
		 * Returns the error code
		 *
		 * @return string
		 */
		public function getError(){ }


		/**
		 * Returns the file key
		 *
		 * @return string
		 */
		public function getKey(){ }


		public function isUploadedFile(){ }


		/**
		 * Moves the temporary file to a destination within the application
		 *
		 * @param string $destination
		 * @return boolean
		 */
		public function moveTo($destination){ }


		public static function __set_state($file, $key=null){ }

	}
}
