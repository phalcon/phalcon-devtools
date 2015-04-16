<?php

namespace Phalcon\Mvc\Collection;

class Document implements \ArrayAccess
{

    /**
     * Checks whether an offset exists in the document
     *
     * @param int $index 
     * @return boolean 
     */
	public function offsetExists($index) {}

    /**
     * Returns the value of a field using the ArrayAccess interfase
     *
     * @param string $index 
     * @return mixed 
     */
	public function offsetGet($index) {}

    /**
     * Change a value using the ArrayAccess interface
     *
     * @param string $index 
     * @param \Phalcon\Mvc\ModelInterface $value 
     */
	public function offsetSet($index, $value) {}

    /**
     * Rows cannot be changed. It has only been implemented to meet the definition of the ArrayAccess interface
     *
     * @param string $offset 
     */
	public function offsetUnset($offset) {}

    /**
     * Reads an attribute value by its name
     * <code>
     * echo robot->readAttribute('name');
     * </code>
     *
     * @param string $attribute 
     * @return mixed 
     */
	public function readAttribute($attribute) {}

    /**
     * Writes an attribute value by its name
     * <code>
     * robot->writeAttribute('name', 'Rosey');
     * </code>
     *
     * @param string $attribute 
     * @param mixed $value 
     */
	public function writeAttribute($attribute, $value) {}

}
