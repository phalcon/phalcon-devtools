<?php 

namespace Phalcon\Acl {

    /**
     * Phalcon\Acl\Role
     *
     * This class defines role entity and its description
     */
    class Role implements \Phalcon\Acl\RoleInterface
    {

        protected $_name;

        protected $_description;

        /**
         * \Phalcon\Acl\Role constructor
         *
         * @param string name
         * @param string description
         */
        public function __construct($name, $description=null)
        {
        }


        /**
         * Role name
         * @var string
         */
        public function getName()
        {
        }


        /**
         * Role description
         * @var string
         */
        public function getDescription()
        {
        }


        /**
         * Role name
         * @var string
         */
        public function __toString()
        {
        }

    }
}
