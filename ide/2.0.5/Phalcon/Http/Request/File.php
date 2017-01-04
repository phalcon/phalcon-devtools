<?php

namespace Phalcon\Http\Request;

use Phalcon\Http\Request\FileInterface;


class File implements FileInterface
{

	protected $_name;

	protected $_tmp;

	protected $_size;

	protected $_type;

	protected $_realType;

	protected $_error;

	public function getError() {
		return $this->_error;
	}

	protected $_key;

	public function getKey() {
		return $this->_key;
	}

	protected $_extension;

	public function getExtension() {
		return $this->_extension;
	}



	/**
	 * Phalcon\Http\Request\File constructor
	 * 
	 * @param array $file
	 * @param $key
	 */
	public function __construct(array $file, $key=null) {}

	/**
	 * Returns the file size of the uploaded file
	 *
	 * @return int
	 */
	public function getSize() {}

	/**
	 * Returns the real name of the uploaded file
	 *
	 * @return string
	 */
	public function getName() {}

	/**
	 * Returns the temporal name of the uploaded file
	 *
	 * @return string
	 */
	public function getTempName() {}

	/**
	 * Returns the mime type reported by the browser
	 * This mime type is not completely secure, use getRealType() instead
	 *
	 * @return string
	 */
	public function getType() {}

	/**
	 * Gets the real mime type of the upload file using finfo
	 *
	 * @return string
	 */
	public function getRealType() {}

	/**
	 * Checks whether the file has been uploaded via Post.
	 *
	 * @return boolean
	 */
	public function isUploadedFile() {}

	/**
	 * Moves the temporary file to a destination within the application
	 * 
	 * @param string $destination
	 *
	 * @return boolean
	 */
	public function moveTo($destination) {}

}
