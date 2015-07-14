<?php

namespace Phalcon;

use Phalcon\FilterInterface;
use Phalcon\Filter\Exception;


class Filter implements FilterInterface
{

	const FILTER_EMAIL      = "email";

	const FILTER_ABSINT     = "absint";

	const FILTER_INT        = "int";

	const FILTER_INT_CAST   = "int!";

	const FILTER_STRING     = "string";

	const FILTER_FLOAT      = "float";

	const FILTER_FLOAT_CAST = "float!";

	const FILTER_ALPHANUM   = "alphanum";

	const FILTER_TRIM       = "trim";

	const FILTER_STRIPTAGS  = "striptags";

	const FILTER_LOWER      = "lower";

	const FILTER_UPPER      = "upper";



	protected $_filters;



	/**
	 * Adds a user-defined filter
	 * 
	 * @param string $name
	 * @param $handler
	 *
	 * @return Filter
	 */
	public function add($name, $handler) {}

	/**
	 * Sanitizes a value with a specified single or set of filters
	 * 
	 * @param mixed $value
	 * @param mixed $filters
	 * @param boolean $noRecursive
	 *
	 * @return mixed
	 */
	public function sanitize($value, $filters, $noRecursive=false) {}

	/**
		 * Apply an array of filters
	 * 
	 * @param mixed $value
	 * @param string $filter
		 *
	 * @return mixed
	 */
	protected function _sanitize($value, $filter) {}

	/**
			 * If the filter is a closure we call it in the PHP userland
			 *
	 * @return array
	 */
	public function getFilters() {}

}
