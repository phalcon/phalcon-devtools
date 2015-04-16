<?php

namespace Phalcon\Annotations\Adapter;

class Xcache extends \Phalcon\Annotations\Adapter implements \Phalcon\Annotations\AdapterInterface
{

    /**
     * Reads parsed annotations from XCache
     *
     * @param string $key 
     * @return \Phalcon\Annotations\Reflection 
     */
	public function read($key) {}

    /**
     * Writes parsed annotations to XCache
     *
     * @param string $key 
     * @param mixed $data 
     * @param \Phalcon\Annotations\Reflection $$data 
     */
	public function write($key, \Phalcon\Annotations\Reflection $data) {}

}
