<?php

namespace Phalcon\Assets\Filters;

class None implements \Phalcon\Assets\FilterInterface
{

    /**
     * Returns the content without be touched
     *
     * @param string $content 
     * @return string 
     */
	public function filter($content) {}

}
