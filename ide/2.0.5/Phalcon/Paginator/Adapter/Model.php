<?php

namespace Phalcon\Paginator\Adapter;

use Phalcon\Paginator\Exception;
use Phalcon\Paginator\Adapter;
use Phalcon\Paginator\AdapterInterface;


class Model extends Adapter implements AdapterInterface
{

	/**
	 * Configuration of paginator by model
	 */
	protected $_config = null;



	/**
	 * Phalcon\Paginator\Adapter\Model constructor
	 * 
	 * @param array $config
	 */
	public function __construct(array $config) {}

	/**
	 * Returns a slice of the resultset to show in the pagination
	 *
	 * @return \stdclass
	 */
	public function getPaginate() {}

}
