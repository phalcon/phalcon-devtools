<?php

namespace Phalcon\Assets;

interface FilterInterface
{

    /**
     * Filters the content returning a string with the filtered content
     *
     * @param string $content 
     * @return string 
     */
	public function filter($content);

}
