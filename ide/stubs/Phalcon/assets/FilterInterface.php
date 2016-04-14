<?php

namespace Phalcon\Assets;

/**
 * Phalcon\Assets\FilterInterface
 * Interface for custom Phalcon\Assets filters
 */
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
