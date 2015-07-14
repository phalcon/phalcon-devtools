<?php

namespace Phalcon\Annotations\Adapter;

use Phalcon\Annotations\Adapter;
use Phalcon\Annotations\AdapterInterface;
use Phalcon\Annotations\Reflection;


class Xcache extends Adapter implements AdapterInterface
{

	/**
	 * Reads parsed annotations from XCache
	 *
	 * @param string $key
	 * 
	 * @return Reflection|boolean
	 */
	public function read($key) {}

	/**
	 * Writes parsed annotations to XCache
	 * 
	 * @param string $key
	 * @param Reflection $data
	 *
	 * @return void
	 */
	public function write($key, Reflection $data) {}

}
