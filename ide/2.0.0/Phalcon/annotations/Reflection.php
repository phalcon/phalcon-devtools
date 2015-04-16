<?php

namespace Phalcon\Annotations;

class Reflection
{

    protected $_reflectionData;


    protected $_classAnnotations;


    protected $_methodAnnotations;


    protected $_propertyAnnotations;


    /**
     * Phalcon\Annotations\Reflection constructor
     *
     * @param array $reflectionData 
     */
	public function __construct($reflectionData = null) {}

    /**
     * Returns the annotations found in the class docblock
     *
     * @return \Phalcon\Annotations\Collection|false 
     */
	public function getClassAnnotations() {}

    /**
     * Returns the annotations found in the methods' docblocks
     *
     * @return \Phalcon\Annotations\Collection[] 
     */
	public function getMethodsAnnotations() {}

    /**
     * Returns the annotations found in the properties' docblocks
     *
     * @return \Phalcon\Annotations\Collection[] 
     */
	public function getPropertiesAnnotations() {}

    /**
     * Returns the raw parsing intermediate definitions used to construct the reflection
     *
     * @return array 
     */
	public function getReflectionData() {}

    /**
     * Restores the state of a Phalcon\Annotations\Reflection variable export
     *
     * @param mixed $data 
     * @return array 
     */
	public static function __set_state($data) {}

}
