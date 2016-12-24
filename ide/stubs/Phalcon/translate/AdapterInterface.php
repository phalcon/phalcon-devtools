<?php

namespace Phalcon\Translate;

/**
 * Phalcon\Translate\AdapterInterface
 *
 * Interface for Phalcon\Translate adapters
 */
interface AdapterInterface
{

    /**
     * Returns the translation string of the given key
     *
     * @param	string translateKey
     * @param	array placeholders
     * @return	string
     * @param string $translateKey
     * @param mixed $placeholders
     * @return string
     */
    public function t($translateKey, $placeholders = null);

    /**
     * Returns the translation related to the given key
     *
     * @param	string index
     * @param	array placeholders
     * @return	string
     * @param string $index
     * @param mixed $placeholders
     * @return string
     */
    public function query($index, $placeholders = null);

    /**
     * Check whether is defined a translation key in the internal array
     *
     * @param string $index
     * @return bool
     */
    public function exists($index);

}
