<?php

namespace Phalcon\Annotations;

use Phalcon\Annotations\Annotation;
use Phalcon\Annotations\Exception;


class Collection implements \Iterator, \Countable
{

	protected $_position;

	protected $_annotations;



	/**
	 * Phalcon\Annotations\Collection constructor
	 * 
	 * @param mixed $reflectionData
	 *
	 */
	public function __construct($reflectionData=null) {}

	/**
	 * Returns the number of annotations in the collection
	 *
	 * @return int
	 */
	public function count() {}

	/**
	 * Rewinds the internal iterator
	 *
	 * @return void
	 */
	public function rewind() {}

	/**
	 * Returns the current annotation in the iterator
	 *
	 * @return Annotation|boolean
	 */
	public function current() {}

	/**
	 * Returns the current position/key in the iterator
	 *
	 * @return int
	 */
	public function key() {}

	/**
	 * Moves the internal iteration pointer to the next position
	 *
	 * @return void
	 */
	public function next() {}

	/**
	 * Check if the current annotation in the iterator is valid
	 *
	 * @return boolean
	 */
	public function valid() {}

	/**
	 * Returns the internal annotations as an array
	 *
	 * @return Annotation[]
	 */
	public function getAnnotations() {}

	/**
	 * Returns the first annotation that match a name
	 * 
	 * @param string $name
	 *
	 * @return Annotation
	 */
	public function get($name) {}

	/**
	 * Returns all the annotations that match a name
	 * 
	 * @param string $name
	 *
	 * @return Annotation[]
	 */
	public function getAll($name) {}

	/**
	 * Check if an annotation exists in a collection
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function has($name) {}

}
