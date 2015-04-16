<?php

namespace Phalcon;

class Filter implements \Phalcon\FilterInterface
{

    protected $_filters;


    /**
     * Adds a user-defined filter
     *
     * @param string $name 
     * @param mixed $handler 
     * @return Filter 
     */
	public function add($name, $handler) {}

    /**
     * Sanitizes a value with a specified single or set of filters
     *
     * @param mixed $value 
     * @param mixed $filters 
     * @param bool $noRecursive 
     */
	public function sanitize($value, $filters, $noRecursive = false) {}

    /**
     * Internal sanitize wrapper to filter_var
     *
     * @param mixed $value 
     * @param string $filter 
     */
	protected function _sanitize($value, $filter) {}

    /**
     * Return the user-defined filters in the instance
     *
     * @return array 
     */
	public function getFilters() {}

}
