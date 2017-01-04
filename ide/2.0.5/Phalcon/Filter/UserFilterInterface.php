<?php

namespace Phalcon\Filter;

interface UserFilterInterface
{

	/**
	 * Filters a value
	 * 
	 * @param $value
	 */
	public function filter($value);

}
