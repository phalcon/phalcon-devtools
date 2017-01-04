<?php

namespace Phalcon\Annotations\Adapter;

use Phalcon\Annotations\Adapter;
use Phalcon\Annotations\AdapterInterface;
use Phalcon\Annotations\Reflection;


class Apc extends Adapter implements AdapterInterface
{

	protected $_prefix = '';

	protected $_ttl = 172800;



	/**
	 * Phalcon\Annotations\Adapter\Apc constructor
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Reads parsed annotations from APC
	 *
	 * @param string $key
	 * 
	 * @return Reflection|boolean
	 */
	public function read($key) {}

	/**
	 * Writes parsed annotations to APC
	 * 
	 * @param string $key
	 * @param Reflection $data
	 *
	 * @return mixed
	 */
	public function write($key, Reflection $data) {}

}
