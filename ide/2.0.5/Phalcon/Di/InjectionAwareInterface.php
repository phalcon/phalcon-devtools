<?php

namespace Phalcon\Di;

use Phalcon\DiInterface;


interface InjectionAwareInterface
{

	/**
	 * Sets the dependency injector
	 * 
	 * @param DiInterface $dependencyInjector
	 */
	public function setDI(DiInterface $dependencyInjector);

	/**
	 * Returns the internal dependency injector
	 *
	 * @return DiInterface
	 */
	public function getDI();

}
