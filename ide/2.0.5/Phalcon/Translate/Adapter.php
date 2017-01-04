<?php

namespace Phalcon\Translate;

use Phalcon\Translate\Exception;


abstract class Adapter
{

	/**
	 * Returns the translation string of the given key
	 *
	 * @param string $translateKey
	 * @param array $placeholders
	 * 
	 * @return string
	 */
	public function t($translateKey, $placeholders=null) {}

	/**
	 * Returns the translation string of the given key (alias of method 't')
	 *
	 * @param string $translateKey
	 * @param array $placeholders
	 * 
	 * @return string
	 */
	public function _($translateKey, $placeholders=null) {}

	/**
	 * Sets a translation value
	 * 
	 * @param mixed $offset
	 * @param mixed $value
	 *
	 *
	 * @return void
	 */
	public function offsetSet($offset, $value) {}

	/**
	 * Check whether a translation key exists
	 * 
	 * @param string $translateKey
	 *
	 * @return boolean
	 */
	public function offsetExists($translateKey) {}

	/**
	 * Unsets a translation from the dictionary
	 * 
	 * @param mixed $offset
	 *
	 *
	 * @return void
	 */
	public function offsetUnset($offset) {}

	/**
	 * Returns the translation related to the given key
	 *
	 * @param string $translateKey
	 * 
	 * @return mixed
	 */
	public function offsetGet($translateKey) {}

	/**
	 * Replaces placeholders by the values passed
	 * 
	 * @param string $translation
	 * @param $placeholders	
	 *
	 * @return string
	 */
	protected function replacePlaceholders($translation, $placeholders=null) {}

}
