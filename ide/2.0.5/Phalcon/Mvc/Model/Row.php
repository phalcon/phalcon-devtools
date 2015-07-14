<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\EntityInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\Model\ResultInterface;


class Row implements EntityInterface, ResultInterface, \ArrayAccess
{

	/**
	 * Set the current object's state
	 * 
	 * @param int $dirtyState
	 *
	 * @return boolean
	 */
	public function setDirtyState($dirtyState) {}

	/**
	 * Checks whether offset exists in the row
	 *
	 * @param mixed $index
	 * 
	 * @return boolean
	 */
	public function offsetExists($index) {}

	/**
	 * Gets a record in a specific position of the row
	 *
	 * @param mixed $index
	 * 
	 * @return mixed
	 */
	public function offsetGet($index) {}

	/**
	 * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
	 * 
	 * @param mixed $index
	 * @param mixed $value
	 *
	 *
	 * @return void
	 */
	public function offsetSet($index, $value) {}

	/**
	 * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
	 * 
	 * @param int $offset
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
