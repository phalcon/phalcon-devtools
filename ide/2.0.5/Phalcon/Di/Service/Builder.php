<?php

namespace Phalcon\Di\Service;

use Phalcon\Di\Exception;
use Phalcon\DiInterface;


class Builder
{

	/**
	 * Resolves a constructor/call parameter
	 *
	 * @param DiInterface $dependencyInjector
	 * @param int $position
	 * @param array $argument
	 * 
	 * @return mixed
	 */
	private function _buildParameter(DiInterface $dependencyInjector, $position, array $argument) {}

	/**
		 * All the arguments must have a type
	 * 
	 * @param DiInterface $dependencyInjector
	 * @param array $arguments
		 *
	 * @return array
	 */
	private function _buildParameters(DiInterface $dependencyInjector, array $arguments) {}

	/**
	 * Builds a service using a complex service definition
	 *
	 * @param DiInterface $dependencyInjector
	 * @param array $definition
	 * @param array $parameters
	 * 
	 * @return mixed
	 */
	public function build(DiInterface $dependencyInjector, array $definition, $parameters=null) {}

}
