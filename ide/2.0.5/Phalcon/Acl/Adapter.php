<?php

namespace Phalcon\Acl;

use Phalcon\Events\ManagerInterface;
use Phalcon\Events\EventsAwareInterface;


abstract class Adapter implements AdapterInterface, EventsAwareInterface
{

	/**
	 * Events manager
	 * @var mixed
	 */
	protected $_eventsManager;

	/**
	 * Default access
	 * @var bool
	 */
	protected $_defaultAccess = true;

	/**
	 * Access Granted
	 * @var bool
	 */
	protected $_accessGranted = false;

	/**
	 * Role which the list is checking if it's allowed to certain resource/access
	 * @var mixed
	 */
	protected $_activeRole;

	public function getActiveRole() {
		return $this->_activeRole;
	}

	/**
	 * Resource which the list is checking if some role can access it
	 * @var mixed
	 */
	protected $_activeResource;

	public function getActiveResource() {
		return $this->_activeResource;
	}

	/**
	 * Active access which the list is checking if some role can access it
	 * @var mixed
	 */
	protected $_activeAccess;

	public function getActiveAccess() {
		return $this->_activeAccess;
	}



	/**
	 * Sets the events manager
	 * 
	 * @param ManagerInterface $eventsManager
	 *
	 * @return void
	 */
	public function setEventsManager(ManagerInterface $eventsManager) {}

	/**
	 * Returns the internal event manager
	 *
	 * @return ManagerInterface
	 */
	public function getEventsManager() {}

	/**
	 * Sets the default access level (Phalcon\Acl::ALLOW or Phalcon\Acl::DENY)
	 * 
	 * @param int $defaultAccess
	 *
	 * @return void
	 */
	public function setDefaultAction($defaultAccess) {}

	/**
	 * Returns the default ACL access level
	 *
	 * @return int
	 */
	public function getDefaultAction() {}

}
