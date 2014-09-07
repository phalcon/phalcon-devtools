<?php 

namespace Phalcon\Acl {

    /**
     * Phalcon\Acl\Adapter
     *
     * Adapter for Phalcon\Acl adapters
     */
    abstract class Adapter implements \Phalcon\Events\EventsAwareInterface, \Phalcon\Acl\AdapterInterface
    {

        protected $_eventsManager;

        protected $_defaultAccess;

        protected $_accessGranted;

        protected $_activeRole;

        protected $_activeResource;

        protected $_activeAccess;

        /**
         * Sets the events manager
         *
         * @param \Phalcon\Events\ManagerInterface eventsManager
         */
        public function setEventsManager($eventsManager)
        {
        }


        /**
         * Returns the internal event manager
         *
         * @return \Phalcon\Events\ManagerInterface
         */
        public function getEventsManager()
        {
        }


        /**
         * Sets the default access level (Phalcon\Acl::ALLOW or \Phalcon\Acl::DENY)
         *
         * @param int defaultAccess
         */
        public function setDefaultAction($defaultAccess)
        {
        }


        /**
         * Returns the default ACL access level
         *
         * @return int
         */
        public function getDefaultAction()
        {
        }


        /**
         * Role which the list is checking if it's allowed to certain resource/access
         * @var mixed
         */
        public function getActiveRole()
        {
        }


        /**
         * Resource which the list is checking if some role can access it
         * @var mixed
         */
        public function getActiveResource()
        {
        }


        /**
         * Active access which the list is checking if some role can access it
         * "@var mixed
         */
        public function getActiveAccess()
        {
        }

    }
}
