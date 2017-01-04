<?php

namespace Phalcon\Mvc\Model\MetaData;

use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\MetaDataInterface;
use Phalcon\Mvc\Model\Exception;


class Files extends MetaData implements MetaDataInterface
{

	protected $_metaDataDir = './';



	/**
	 * Phalcon\Mvc\Model\MetaData\Files constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Reads meta-data from files
	 *
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public function read($key) {}

	/**
	 * Writes the meta-data to files
	 * 
	 * @param string $key
	 * @param mixed $data
	 *
	 *
	 * @return void
	 */
	public function write($key, $data) {}

}
