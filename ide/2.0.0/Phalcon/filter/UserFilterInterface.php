<?php

namespace Phalcon\Filter;

interface UserFilterInterface
{

    /**
     * Filters a value
     *
     * @param mixed $value 
     */
	public function filter($value);

}
