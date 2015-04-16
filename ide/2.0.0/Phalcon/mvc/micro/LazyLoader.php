<?php

namespace Phalcon\Mvc\Micro;

class LazyLoader
{

    protected $_handler;


    protected $_definition;


    /**
     * Phalcon\Mvc\Micro\LazyLoader constructor
     *
     * @param string $definition 
     */
	public function __construct($definition) {}

    /**
     * Initializes the internal handler, calling functions on it
     *
     * @param string $method 
     * @param array $arguments 
     * @return mixed 
     */
	public function __call($method, $arguments) {}

}
