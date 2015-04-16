<?php

namespace Phalcon\Annotations;

class Collection implements \Iterator, \Countable
{

    protected $_position = 0;


    protected $_annotations;


    /**
     * Phalcon\Annotations\Collection constructor
     *
     * @param array $reflectionData 
     */
	public function __construct($reflectionData = null) {}

    /**
     * Returns the number of annotations in the collection
     *
     * @return int 
     */
	public function count() {}

    /**
     * Rewinds the internal iterator
     */
	public function rewind() {}

    /**
     * Returns the current annotation in the iterator
     *
     * @return \Phalcon\Annotations\Annotation 
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
     * @return \Phalcon\Annotations\Annotation[] 
     */
	public function getAnnotations() {}

    /**
     * Returns the first annotation that match a name
     *
     * @param string $name 
     * @return \Phalcon\Annotations\Annotation 
     */
	public function get($name) {}

    /**
     * Returns all the annotations that match a name
     *
     * @param string $name 
     * @return \Phalcon\Annotations\Annotation[] 
     */
	public function getAll($name) {}

    /**
     * Check if an annotation exists in a collection
     *
     * @param string $name 
     * @return boolean 
     */
	public function has($name) {}

}
