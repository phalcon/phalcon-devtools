<?php

namespace Phalcon\Annotations;

use Phalcon\Annotations\Collection;


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
	 *
	 */
	public function __construct($reflectionData=null) {}

	/**
	 * Returns the annotations found in the class docblock
	 *
	 * @return Collection|boolean
	 */
	public function getClassAnnotations() {}

	/**
	 * Returns the annotations found in the methods' docblocks
	 *
	 * @return Collection[]|boolean
	 */
	public function getMethodsAnnotations() {}

	/**
	 * Returns the annotations found in the properties' docblocks	 
	 *
	 * @return Collection[]|boolean
	 */
	public function getPropertiesAnnotations() {}

	/**
	 * Returns the raw parsing intermediate definitions used to construct the reflection
	 *
	 * @return mixed
	 */
	public function getReflectionData() {}

	/**
	 * Restores the state of a Phalcon\Annotations\Reflection variable export
	 *
	 * @param $data
	 * 
	 * @return Reflection
	 */
	public static function __set_state($data) {}

}
