<?php

namespace Phalcon\Translate\Adapter;

use Phalcon\Translate\Exception;
use Phalcon\Translate\AdapterInterface;
use Phalcon\Translate\Adapter;


class NativeArray extends Adapter implements AdapterInterface, \ArrayAccess
{

	protected $_translate;



	/**
	 * Phalcon\Translate\Adapter\NativeArray constructor
	 * 
	 * @param array $options
	 */
	public function __construct(array $options) {}

	/**
	 * Returns the translation related to the given key
	 * 
	 * @param string $index
	 * @param $placeholders
	 *
	 * @return string
	 */
	public function query($index, $placeholders=null) {}

	/**
	 * Check whether is defined a translation key in the internal array
	 * 
	 * @param string $index
	 *
	 * @return boolean
	 */
	public function exists($index) {}

}
