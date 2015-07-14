<?php

namespace Phalcon\Mvc\View\Engine;

use Phalcon\Mvc\View\Engine;
use Phalcon\Mvc\View\EngineInterface;


class Php extends Engine implements EngineInterface
{

	/**
	 * Renders a view using the template engine
	 * 
	 * @param string $path
	 * @param mixed $params
	 * @param boolean $mustClean
	 *
	 * @return void
	 */
	public function render($path, $params, $mustClean=false) {}

}
