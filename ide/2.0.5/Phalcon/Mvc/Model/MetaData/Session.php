<?php

namespace Phalcon\Mvc\Model\MetaData;

use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\MetaDataInterface;
use Phalcon\Mvc\Model\Exception;


class Session extends MetaData implements MetaDataInterface
{

	protected $_prefix = '';



	/**
	 * Phalcon\Mvc\Model\MetaData\Session constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Reads meta-data from $_SESSION
	 *
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public function read($key) {}

	/**
	 * Writes the meta-data to $_SESSION
	 * 
	 * @param string $key
	 * @param mixed $data
	 *
	 *
	 * @return void
	 */
	public function write($key, $data) {}

}
