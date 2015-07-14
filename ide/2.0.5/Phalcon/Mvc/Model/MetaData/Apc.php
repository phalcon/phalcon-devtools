<?php

namespace Phalcon\Mvc\Model\MetaData;

use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\MetaDataInterface;
use Phalcon\Mvc\Model\Exception;


class Apc extends MetaData implements MetaDataInterface
{

	protected $_prefix = '';

	protected $_ttl = 172800;



	/**
	 * Phalcon\Mvc\Model\MetaData\Apc constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Reads meta-data from APC
	 * 
	 * @param string $key
	 *
	 * @return array|null
	 */
	public function read($key) {}

	/**
	 * Writes the meta-data to APC
	 * 
	 * @param string $key
	 * @param mixed $data
	 *
	 * @return void
	 */
	public function write($key, $data) {}

}
