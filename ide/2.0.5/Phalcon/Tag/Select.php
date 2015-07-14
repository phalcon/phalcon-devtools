<?php

namespace Phalcon\Tag;

use Phalcon\Tag\Exception;
use Phalcon\Tag as BaseTag;


abstract class Select
{

	/**
	 * Generates a SELECT tag
	 * 
	 * @param array $parameters
	 * @param array $data
	 *
	 *
	 * @return mixed
	 */
	public static function selectField($parameters, $data=null) {}

	/**
		 * Automatically assign the id if the name is not an array
	 * 
	 * @param $resultset
	 * @param $using
	 * @param $value
	 * @param $closeOption
		 *
	 * @return mixed
	 */
	private static function _optionsFromResultset($resultset, $using, $value, $closeOption) {}

	/**
				 * If the value is equal to the option"s value we mark it as selected
	 * 
	 * @param mixed $data
	 * @param mixed $value
	 * @param mixed $closeOption
				 *
	 * @return mixed
	 */
	private static function _optionsFromArray($data, $value, $closeOption) {}

}
