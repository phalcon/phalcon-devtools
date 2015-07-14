<?php

namespace Phalcon\Forms\Element;

use Phalcon\Forms\Element;
use Phalcon\Forms\ElementInterface;


class Select extends Element implements ElementInterface {

	protected $_optionsValues;



	/**
	 * Phalcon\Forms\Element constructor
	 * 
	 * @param string $name
	 * @param object|array $options
	 * @param array $attributes
	 *
	 */
	public function __construct($name, $options=null, $attributes=null) {}

	/**
	 * Set the choice's options
	 *
	 * @param mixed $options
	 * 
	 * @return Element
	 */
	public function setOptions($options) {}

	/**
	 * Returns the choices' options
	 *
	 * @return mixed
	 */
	public function getOptions() {}

	/**
	 * Adds an option to the current options
	 *
	 * @param mixed $option
	 * 
	 * @return Element
	 */
	public function addOption($option) {}

	/**
	 * Renders the element widget returning html
	 *
	 * @param array $attributes
	 * 
	 * @return string
	 */
	public function render($attributes=null) {}

}
