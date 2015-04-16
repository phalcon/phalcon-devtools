<?php

namespace Phalcon\Http\Request;

class File implements \Phalcon\Http\Request\FileInterface
{

    protected $_name;


    protected $_tmp;


    protected $_size;


    protected $_type;


    protected $_realType;


    protected $_error;


    protected $_key;


    protected $_extension;



	public function getError() {}


	public function getKey() {}


	public function getExtension() {}

    /**
     * Phalcon\Http\Request\File constructor
     *
     * @param array $file 
     * @param mixed $key 
     */
	public function __construct($file, $key = null) {}

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
     * @return bool 
     */
	public function isUploadedFile() {}

    /**
     * Moves the temporary file to a destination within the application
     *
     * @param string $destination 
     * @return bool 
     */
	public function moveTo($destination) {}

}
