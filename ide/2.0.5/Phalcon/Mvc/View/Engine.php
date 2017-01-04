<?php

namespace Phalcon\Mvc\View;

use Phalcon\DiInterface;
use Phalcon\Di\Injectable;
use Phalcon\Mvc\ViewBaseInterface;


abstract class Engine extends Injectable
{

	protected $_view;



	/**
	 * Phalcon\Mvc\View\Engine constructor
	 * 
	 * @param ViewBaseInterface $view
	 * @param DiInterface $dependencyInjector
	 */
	public function __construct(ViewBaseInterface $view, DiInterface $dependencyInjector=null) {}

	/**
	 * Returns cached output on another view stage
	 *
	 * @return string
	 */
	public function getContent() {}

	/**
	 * Renders a partial inside another view
	 *
	 * @param string $partialPath
	 * @param mixed $params
	 * 
	 * @return string
	 */
	public function partial($partialPath, $params=null) {}

	/**
	 * Returns the view component related to the adapter
	 *
	 * @return ViewBaseInterface
	 */
	public function getView() {}

}
