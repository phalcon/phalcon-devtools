<?php

namespace Phalcon\Annotations\Adapter;

use Phalcon\Annotations\Adapter;
use Phalcon\Annotations\AdapterInterface;
use Phalcon\Annotations\Reflection;


class Memory extends Adapter implements AdapterInterface
{

	/**
	 * Data
	 * @var mixed
	 */
	protected $_data;



	/**
	* Reads parsed annotations from memory
	*
	 * @param string $key
	 * 
	* @return Reflection|boolean
	 */
	public function read($key) {}

	/**
	 * Writes parsed annotations to memory
	 * 
	 * @param string $key
	 * @param Reflection $data
	 *
	 * @return void
	 */
	public function write($key, Reflection $data) {}

}
