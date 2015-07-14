<?php

namespace Phalcon\Di;

use Phalcon\DiInterface;
use Phalcon\Di\Exception;
use Phalcon\Di\ServiceInterface;
use Phalcon\Di\Service\Builder;


class Service implements ServiceInterface
{

	protected $_name;

	protected $_definition;

	protected $_shared = false;

	protected $_resolved = false;

	protected $_sharedInstance;



	/**
	 * Phalcon\Di\Service
	 * 
	 * @param string $name
	 * @param mixed $definition
	 * @param boolean $shared
	 *
	 */
	public final function __construct($name, $definition, $shared=false) {}

	/**
	 * Returns the service's name
	 *
	 * @return string
	 */
	public function getName() {}

	/**
	 * Sets if the service is shared or not
	 * 
	 * @param boolean $shared
	 *
	 * @return void
	 */
	public function setShared($shared) {}

	/**
	 * Check whether the service is shared or not
	 *
	 * @return boolean
	 */
	public function isShared() {}

	/**
	 * Sets/Resets the shared instance related to the service
	 * 
	 * @param mixed $sharedInstance
	 *
	 *
	 * @return void
	 */
	public function setSharedInstance($sharedInstance) {}

	/**
	 * Set the service definition
	 * 
	 * @param mixed $definition
	 *
	 *
	 * @return void
	 */
	public function setDefinition($definition) {}

	/**
	 * Returns the service definition
	 *
	 * @return mixed
	 */
	public function getDefinition() {}

	/**
	 * Resolves the service
	 *
	 * @param array $parameters
	 * @param DiInterface $dependencyInjector
	 * 
	 * @return mixed
	 */
	public function resolve($parameters=null, DiInterface $dependencyInjector=null) {}

	/**
		 * Check if the service is shared
	 * 
	 * @param int $position
	 * @param array $parameter
		 *
	 * @return Service
	 */
	public function setParameter($position, array $parameter) {}

	/**
		 * Update the parameter
	 * 
	 * @param int $position
		 *
	 * @return mixed
	 */
	public function getParameter($position) {}

	/**
		 * Update the parameter
		 *
	 * @return boolean
	 */
	public function isResolved() {}

	/**
	 * Restore the internal state of a service
	 * 
	 * @param array $attributes
	 *
	 * @return Service
	 */
	public static function __set_state(array $attributes) {}

}
