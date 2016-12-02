<?php

namespace Phalcon\Acl;

/**
 * Phalcon\Acl\Adapter
 *
 * Adapter for Phalcon\Acl adapters
 */
abstract class Adapter implements \Phalcon\Acl\AdapterInterface, \Phalcon\Events\EventsAwareInterface
{
    /**
     * Events manager
     *
     * @var mixed
     */
    protected $_eventsManager;

    /**
     * Default access
     *
     * @var bool
     */
    protected $_defaultAccess = true;

    /**
     * Access Granted
     *
     * @var bool
     */
    protected $_accessGranted = false;

    /**
     * Role which the list is checking if it's allowed to certain resource/access
     *
     * @var mixed
     */
    protected $_activeRole;

    /**
     * Resource which the list is checking if some role can access it
     *
     * @var mixed
     */
    protected $_activeResource;

    /**
     * Active access which the list is checking if some role can access it
     *
     * @var mixed
     */
    protected $_activeAccess;


    /**
     * Role which the list is checking if it's allowed to certain resource/access
     *
     * @return mixed
     */
    public function getActiveRole() {}

    /**
     * Resource which the list is checking if some role can access it
     *
     * @return mixed
     */
    public function getActiveResource() {}

    /**
     * Active access which the list is checking if some role can access it
     *
     * @return mixed
     */
    public function getActiveAccess() {}

    /**
     * Sets the events manager
     *
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     */
    public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface
     */
    public function getEventsManager() {}

    /**
     * Sets the default access level (Phalcon\Acl::ALLOW or Phalcon\Acl::DENY)
     *
     * @param int $defaultAccess
     */
    public function setDefaultAction($defaultAccess) {}

    /**
     * Returns the default ACL access level
     *
     * @return int
     */
    public function getDefaultAction() {}

}
