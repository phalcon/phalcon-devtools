<?php 

namespace Phalcon\Acl {

    /**
     * Phalcon\Acl\Resource
     *
     * This class defines resource entity and its description
     */
    class Resource implements \Phalcon\Acl\ResourceInterface
    {

        protected $_name;

        protected $_description;

        /**
         * \Phalcon\Acl\Resource constructor
         *
         * @param string name
         * @param string description
         */
        public function __construct($name, $description=null)
        {
        }


        /**
         * Resource name
         * @var string
         */
        public function getName()
        {
        }


        /**
         * Resource description
         * @var string
         */
        public function getDescription()
        {
        }


        /**
         * Resource name
         * @var string
         */
        public function __toString()
        {
        }

    }
}
