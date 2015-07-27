<?php

namespace Phalcon\Translate\Adapter;

/**
 * Phalcon\Translate\Adapter\Csv
 * Allows to define translation lists using CSV file
 */
class Csv extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess
{

    protected $_translate = array();


    /**
     * Phalcon\Translate\Adapter\Csv constructor
     *
     * @param array $options 
     */
    public function __construct($options) {}

    /**
     * Returns the translation related to the given key
     *
     * @param string $index 
     * @param mixed $placeholders 
     * @return string 
     */
    public function query($index, $placeholders = null) {}

    /**
     * Check whether is defined a translation key in the internal array
     *
     * @param string $index 
     * @return bool 
     */
    public function exists($index) {}


<<<<<<< HEAD
     function zephir_init_properties_Phalcon_Translate_Adapter_Csv() {}
=======
     function zephir_init_properties() {}
>>>>>>> 5cd73180ea748c3d5e180a24610161d9730cd146

}
