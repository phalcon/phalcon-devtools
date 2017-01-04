<?php

namespace Phalcon\Assets\Filters;

use Phalcon\Assets\FilterInterface;


class None implements FilterInterface
{

	/**
	 * Returns the content without be touched
	 * 
	 * @param string $content
	 *
	 * @return string
	 */
	public function filter($content) {}

}
