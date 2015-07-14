<?php

namespace Phalcon\Config\Adapter;

use Phalcon\Config;
use Phalcon\Config\Exception;


class Ini extends Config
{

	/**
	 * Phalcon\Config\Adapter\Ini constructor
	 * 
	 * @param string $filePath
	 */
	public function __construct($filePath) {}

	/**
	 * Build multidimensional array from string
	 *
	 * <code>
	 * $this->_parseIniString('path.hello.world', 'value for last key');
	 *
	 * // result
	 * [
	 *      'path' => [
	 *          'hello' => [
	 *              'world' => 'value for last key',
	 *          ],
	 *      ],
	 * ];
	 * </code>
	 * 
	 * @param string $path
	 * @param mixed $value
	 *
	 * @return array
	 */
	protected function _parseIniString($path, $value) {}

}
