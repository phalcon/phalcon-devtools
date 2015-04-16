<?php

namespace Phalcon;

interface FilterInterface
{

    /**
     * Adds a user-defined filter
     *
     * @param string $name 
     * @param mixed $handler 
     * @return \Phalcon\FilterInterface 
     */
	public function add($name, $handler);

    /**
     * Sanizites a value with a specified single or set of filters
     *
     * @param mixed $value 
     * @param mixed $filters 
     */
	public function sanitize($value, $filters);

    /**
     * Return the user-defined filters in the instance
     *
     * @return array 
     */
	public function getFilters();

}
