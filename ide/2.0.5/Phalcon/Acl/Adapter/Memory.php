<?php

namespace Phalcon\Acl\Adapter;

use Phalcon\Acl;
use Phalcon\Acl\Adapter;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Acl\Exception;
use Phalcon\Events\Manager as EventsManager;


class Memory extends Adapter
{

	/**
	 * Roles Names
	 *
	 * @var mixed
	 */
	protected $_rolesNames;

	/**
	 * Roles
	 *
	 * @var mixed
	 */
	protected $_roles;

	/**
	 * Resource Names
	 *
	 * @var mixed
	 */
	protected $_resourcesNames;

	/**
	 * Resources
	 *
	 * @var mixed
	 */
	protected $_resources;

	/**
	 * Access
	 *
	 * @var mixed
	 */
	protected $_access;

	/**
	 * Role Inherits
	 *
	 * @var mixed
	 */
	protected $_roleInherits;

	/**
	 * Access List
	 *
	 * @var mixed
	 */
	protected $_accessList;



	/**
	 * Phalcon\Acl\Adapter\Memory constructor
	 */
	public function __construct() {}

	/**
	 * Adds a role to the ACL list. Second parameter allows inheriting access data from other existing role
	 *
	 * Example:
	 * <code>
	 * 	$acl->addRole(new Phalcon\Acl\Role('administrator'), 'consultant');
	 * 	$acl->addRole('administrator', 'consultant');
	 * </code>
	 * 
	 * @param $role
	 * @param array|string $accessInherits
	 *
	 *
	 * @return boolean
	 */
	public function addRole($role, $accessInherits=null) {}

	/**
	 * Do a role inherit from another existing role
	 * 
	 * @param string $roleName
	 * @param mixed $roleToInherit
	 *
	 * @return boolean
	 */
	public function addInherit($roleName, $roleToInherit) {}

	/**
		 * Deep inherits
	 * 
	 * @param string $roleName
		 *
	 * @return boolean
	 */
	public function isRole($roleName) {}

	/**
	 * Check whether resource exist in the resources list
	 * 
	 * @param string $resourceName
	 *
	 * @return boolean
	 */
	public function isResource($resourceName) {}

	/**
	 * Adds a resource to the ACL list
	 *
	 * Access names can be a particular action, by example
	 * search, update, delete, etc or a list of them
	 *
	 * Example:
	 * <code>
	 * //Add a resource to the the list allowing access to an action
	 * $acl->addResource(new Phalcon\Acl\Resource('customers'), 'search');
	 * $acl->addResource('customers', 'search');
	 *
	 * //Add a resource  with an access list
	 * $acl->addResource(new Phalcon\Acl\Resource('customers'), array('create', 'search'));
	 * $acl->addResource('customers', array('create', 'search'));
	 * </code>
	 * 
	 * @param mixed $resourceValue
	 * @param mixed $accessList
	 *
	 *
	 * @return boolean
	 */
	public function addResource($resourceValue, $accessList) {}

	/**
	 * Adds access to resources
	 * 
	 * @param string $resourceName
	 * @param mixed $accessList
	 *
	 *
	 * @return boolean
	 */
	public function addResourceAccess($resourceName, $accessList) {}

	/**
	 * Removes an access from a resource
	 * 
	 * @param string $resourceName
	 * @param mixed $accessList
	 *
	 *
	 * @return void
	 */
	public function dropResourceAccess($resourceName, $accessList) {}

	/**
	 * Checks if a role has access to a resource
	 * 
	 * @param string $roleName
	 * @param string $resourceName
	 * @param mixed $access
	 * @param mixed $action
	 *
	 * @return void
	 */
	protected function _allowOrDeny($roleName, $resourceName, $access, $action) {}

	/**
			 * Define the access action for the specified accessKey
	 * 
	 * @param string $roleName
	 * @param string $resourceName
	 * @param mixed $access
			 *
	 * @return mixed
	 */
	public function allow($roleName, $resourceName, $access) {}

	/**
	 * Deny access to a role on a resource
	 *
	 * You can use '*' as wildcard
	 *
	 * Example:
	 * <code>
	 * //Deny access to guests to search on customers
	 * $acl->deny('guests', 'customers', 'search');
	 *
	 * //Deny access to guests to search or create on customers
	 * $acl->deny('guests', 'customers', array('search', 'create'));
	 *
	 * //Deny access to any role to browse on products
	 * $acl->deny('*', 'products', 'browse');
	 *
	 * //Deny access to any role to browse on any resource
	 * $acl->deny('*', '*', 'browse');
	 * </code>
	 * 
	 * @param string $roleName
	 * @param string $resourceName
	 * @param mixed $access
	 *
	 * @return mixed
	 */
	public function deny($roleName, $resourceName, $access) {}

	/**
	 * Check whether a role is allowed to access an action from a resource
	 *
	 * <code>
	 * //Does andres have access to the customers resource to create?
	 * $acl->isAllowed('andres', 'Products', 'create');
	 *
	 * //Do guests have access to any resource to edit?
	 * $acl->isAllowed('guests', '*', 'edit');
	 * </code>
	 * 
	 * @param string $roleName
	 * @param string $resourceName
	 * @param string $access
	 *
	 * @return boolean
	 */
	public function isAllowed($roleName, $resourceName, $access) {}

	/**
		 * Check if the role exists
		 *
	 * @return Role[]
	 */
	public function getRoles() {}

	/**
	 * Return an array with every resource registered in the list
	 *
	 * @return 
	 */
	public function getResources() {}

}
