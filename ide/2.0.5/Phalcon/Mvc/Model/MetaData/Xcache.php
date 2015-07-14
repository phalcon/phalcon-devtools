<?php

namespace Phalcon\Mvc\Model\MetaData;

use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\MetaDataInterface;


class Xcache extends MetaData implements MetaDataInterface
{

	protected $_prefix = '';

	protected $_ttl = 172800;



	/**
	 * Phalcon\Mvc\Model\MetaData\Xcache constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Reads metadata from XCache
	 *
	 * @param string $key
	 * 
	 * @return mixed
	 */
	public function read($key) {}

	/**
	 *  Writes the metadata to XCache
	 * 
	 * @param string $key
	 * @param array $data
	 *
	 *
	 * @return void
	 */
	public function write($key, $data) {}

}
