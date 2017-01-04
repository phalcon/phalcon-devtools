<?php

namespace Phalcon\Annotations\Adapter;

use Phalcon\Annotations\Adapter;
use Phalcon\Annotations\AdapterInterface;
use Phalcon\Annotations\Reflection;
use Phalcon\Annotations\Exception;


class Files extends Adapter implements AdapterInterface
{

	protected $_annotationsDir = './';



	/**
	 * Phalcon\Annotations\Adapter\Files constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Reads parsed annotations from files
	 *
	 * @param string $key
	 * 
	 * @return Reflection|boolean|int
	 */
	public function read($key) {}

	/**
		 * Paths must be normalized before be used as keys
	 * 
	 * @param string $key
	 * @param Reflection $data
		 *
	 * @return void
	 */
	public function write($key, Reflection $data) {}

}
