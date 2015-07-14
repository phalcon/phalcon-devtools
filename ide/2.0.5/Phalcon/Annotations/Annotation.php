<?php

namespace Phalcon\Annotations;

use Phalcon\Annotations\Exception;


class Annotation
{

	/**
	 * Annotation Name
	 * @var string
	 */
	protected $_name;

	/**
	 * Annotation Arguments
	 * @var string
	 */
	protected $_arguments;

	/**
	 * Annotation ExprArguments
	 * @var string
	 */
	protected $_exprArguments;



	/**
	 * Phalcon\Annotations\Annotation constructor
	 * 
	 * @param array $reflectionData
	 */
	public function __construct(array $reflectionData) {}

	/**
		 * Process annotation arguments
		 *
	 * @return string
	 */
	public function getName() {}

	/**
	 * Resolves an annotation expression
	 *
	 * @param array $expr
	 * 
	 * @return mixed
	 */
	public function getExpression(array $expr) {}

	/**
	 * Returns the expression arguments without resolving
	 *
	 * @return mixed
	 */
	public function getExprArguments() {}

	/**
	 * Returns the expression arguments
	 *
	 * @return mixed
	 */
	public function getArguments() {}

	/**
	 * Returns the number of arguments that the annotation has
	 *
	 * @return int
	 */
	public function numberArguments() {}

	/**
	 * Returns an argument in a specific position
	 *
	 * @param mixed $position
	 * 
	 * @return mixed
	 */
	public function getArgument($position) {}

	/**
	 * Returns an argument in a specific position
	 *
	 * @param mixed $position
	 * 
	 * @return boolean
	 */
	public function hasArgument($position) {}

	/**
	 * Returns a named argument
	 *
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function getNamedArgument($name) {}

	/**
	 * Returns a named parameter
	 *
	 * @param string $name
	 * 
	 * @return mixed
	 */
	public function getNamedParameter($name) {}

}
