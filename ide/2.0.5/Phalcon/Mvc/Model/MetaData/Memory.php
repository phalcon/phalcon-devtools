<?php

namespace Phalcon\Mvc\Model\MetaData;

use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\MetaDataInterface;
use Phalcon\Mvc\Model\Exception;


class Memory extends MetaData implements MetaDataInterface
{

	/**
	 * Phalcon\Mvc\Model\MetaData\Memory constructor
	 * 
	 * @param mixed $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Reads the meta-data from temporal memory
	 *
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public function read($key) {}

	/**
	 * Writes the meta-data to temporal memory
	 * 
	 * @param string $key
	 * @param mixed $data
	 *
	 *
	 * @return void
	 */
	public function write($key, $data) {}

}
