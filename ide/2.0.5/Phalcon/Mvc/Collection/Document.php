<?php

namespace Phalcon\Mvc\Collection;

use Phalcon\Mvc\EntityInterface;
use Phalcon\Mvc\Collection\Exception;


class Document implements EntityInterface, \ArrayAccess
{

	/**
	 * Checks whether an offset exists in the document
	 *
	 * @param string $index
	 * 
	 * @return boolean
	 */
	public function offsetExists($index) {}

	/**
	 * Returns the value of a field using the ArrayAccess interfase
	 * 
	 * @param string $index
	 *
	 * @return mixed
	 */
	public function offsetGet($index) {}

	/**
	 * Change a value using the ArrayAccess interface
	 * 
	 * @param string $index
	 * @param $value
	 *
	 * @return void
	 */
	public function offsetSet($index, $value) {}

	/**
	 * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
	 * 
	 * @param string $offset
	 *
	 *
	 * @return void
	 */
	public function offsetUnset($offset) {}

	/**
	 * Reads an attribute value by its name
	 *
	 *<code>
	 *  echo $robot->readAttribute('name');
	 *</code>
	 *
	 * @param string $attribute
	 * 
	 * @return mixed
	 */
	public function readAttribute($attribute) {}

	/**
	 * Writes an attribute value by its name
	 *
	 *<code>
	 *  $robot->writeAttribute('name', 'Rosey');
	 *</code>
	 * 
	 * @param string $attribute
	 * @param mixed $value
	 *
	 *
	 * @return void
	 */
	public function writeAttribute($attribute, $value) {}

	/**
	 * Returns the instance as an array representation
	 *
	 * @return mixed
	 */
	public function toArray() {}

}
