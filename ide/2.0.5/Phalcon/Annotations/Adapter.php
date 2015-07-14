<?php

namespace Phalcon\Annotations;

use Phalcon\Annotations\Reader;
use Phalcon\Annotations\Exception;
use Phalcon\Annotations\Collection;
use Phalcon\Annotations\Reflection;
use Phalcon\Annotations\ReaderInterface;


abstract class Adapter
{

	protected $_reader;

	protected $_annotations;



	/**
	 * Sets the annotations parser
	 * 
	 * @param ReaderInterface $reader
	 *
	 * @return void
	 */
	public function setReader(ReaderInterface $reader) {}

	/**
	 * Returns the annotation reader
	 *
	 * @return ReaderInterface
	 */
	public function getReader() {}

	/**
	 * Parses or retrieves all the annotations found in a class
	 * 
	 * @param mixed $className
	 *
	 *
	 * @return Reflection
	 */
	public function get($className) {}

	/**
		 * Get the class name if it's an object
	 * 
	 * @param string $className
		 *
	 * @return array
	 */
	public function getMethods($className) {}

	/**
		 * Get the full annotations from the class
	 * 
	 * @param string $className
	 * @param string $methodName
		 *
	 * @return Collection
	 */
	public function getMethod($className, $methodName) {}

	/**
		 * Get the full annotations from the class
	 * 
	 * @param string $className
		 *
	 * @return array
	 */
	public function getProperties($className) {}

	/**
		 * Get the full annotations from the class
	 * 
	 * @param string $className
	 * @param string $propertyName
		 *
	 * @return Collection
	 */
	public function getProperty($className, $propertyName) {}

}
