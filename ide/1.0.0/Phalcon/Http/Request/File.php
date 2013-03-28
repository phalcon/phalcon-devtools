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

		/**
		 * \Phalcon\Http\Request\File constructor
		 *
		 * @param array $file
		 */
		public function __construct($file){ }


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
		 * Move the temporary file to a destination whithin the application
		 *
		 * @param string $destination
		 * @return boolean
		 */
		public function moveTo($destination){ }

	}
}
