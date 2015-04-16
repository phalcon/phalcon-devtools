<?php

namespace Phalcon;

abstract class Db
{

    const FETCH_ASSOC = 1;


    const FETCH_BOTH = 2;


    const FETCH_NUM = 3;


    const FETCH_OBJ = 4;


    /**
     * Enables/disables options in the Database component
     *
     * @param array $options 
     */
	public static function setup($options) {}

}
