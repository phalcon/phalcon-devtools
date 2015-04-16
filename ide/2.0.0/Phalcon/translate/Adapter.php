<?php

namespace Phalcon\Translate;

abstract class Adapter
{

    /**
     * Returns the translation string of the given key
     *
     * @param string $translateKey 
     * @param array $placeholders 
     * @return string 
     */
	public function t($translateKey, $placeholders = null) {}

    /**
     * Returns the translation string of the given key (alias of method 't')
     *
     * @param string $translateKey 
     * @param array $placeholders 
     * @return string 
     */
	public function _($translateKey, $placeholders = null) {}

    /**
     * Sets a translation value
     *
     * @param string $offset 
     * @param string $value 
     */
	public function offsetSet($offset, $value) {}

    /**
     * Check whether a translation key exists
     *
     * @param string $translateKey 
     * @return bool 
     */
	public function offsetExists($translateKey) {}

    /**
     * Unsets a translation from the dictionary
     *
     * @param string $offset 
     */
	public function offsetUnset($offset) {}

    /**
     * Returns the translation related to the given key
     *
     * @param string $translateKey 
     * @return string 
     */
	public function offsetGet($translateKey) {}

    /**
     * Replaces placeholders by the values passed
     *
     * @param string $translation 
     * @param mixed $placeholders 
     * @return string 
     */
	protected function replacePlaceholders($translation, $placeholders = null) {}

}
