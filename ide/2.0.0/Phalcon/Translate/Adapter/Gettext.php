<?php 

namespace Phalcon\Translate\Adapter {    class Gettext extends \Phalcon\Translate\Adapter implements \Phalcon\Translate\AdapterInterface, \ArrayAccess
    {

        protected $_locale;

        protected $_defaultDomain;

        protected $_directory;

        public function __construct($options)
        {
        }


        public function query($index, $placeholders=null)
        {
        }


        public function exists($index)
        {
        }

    }
}
