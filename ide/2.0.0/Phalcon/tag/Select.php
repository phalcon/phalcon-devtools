<?php

namespace Phalcon\Tag;

abstract class Select
{

    /**
     * Generates a SELECT tag
     *
     * @param array $parameters 
     * @param array $data 
     */
	public static function selectField($parameters, $data = null) {}

    /**
     * Generate the OPTION tags based on a resulset
     *
     * @param \Phalcon\Mvc\Model\Resultset $resultset 
     * @param array $using 
     * @param mixed $value 
     * @param string $closeOption 
     */
	private static function _optionsFromResultset($resultset, $using, $value, $closeOption) {}

    /**
     * Generate the OPTION tags based on an array
     *
     * @param array $data 
     * @param mixed $value 
     * @param string $closeOption 
     */
	private static function _optionsFromArray($data, $value, $closeOption) {}

}
