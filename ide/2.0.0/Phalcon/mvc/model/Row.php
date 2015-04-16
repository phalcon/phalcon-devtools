<?php

namespace Phalcon\Mvc\Model;

class Row implements \ArrayAccess, \Phalcon\Mvc\Model\ResultInterface
{

    /**
     * Set the current object's state
     *
     * @param int $dirtyState 
     */
	public function setDirtyState($dirtyState) {}

    /**
     * Checks whether offset exists in the row
     *
     * @param mixed $index 
     * @param string|int $$index 
     * @return boolean 
     */
	public function offsetExists($index) {}

    /**
     * Gets a record in a specific position of the row
     *
     * @param string|int $index 
     * @return string|Phalcon\Mvc\ModelInterface 
     */
	public function offsetGet($index) {}

    /**
     * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
     *
     * @param string|int $index 
     * @param \Phalcon\Mvc\ModelInterface $value 
     */
	public function offsetSet($index, $value) {}

    /**
     * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
     *
     * @param string|int $offset 
     */
	public function offsetUnset($offset) {}

    /**
     * Returns the instance as an array representation
     *
     * @return array 
     */
	public function toArray() {}

}
