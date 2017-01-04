<?php

namespace Phalcon\Paginator\Adapter;

use Phalcon\Paginator\Exception;
use Phalcon\Paginator\Adapter;
use Phalcon\Paginator\AdapterInterface;


class NativeArray extends Adapter implements AdapterInterface
{

	/**
	 * Configuration of the paginator
	 */
	protected $_config = null;



	/**
	 * Phalcon\Paginator\Adapter\NativeArray constructor
	 * 
	 * @param array $config
	 */
	public function __construct(array $config) {}

	/**
	 * Returns a slice of the resultset to show in the pagination
	 *
	 * @return \stdClass
	 */
	public function getPaginate() {}

}
