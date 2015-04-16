<?php

namespace Phalcon\Acl;

interface AdapterInterface
{

    /**
     * Sets the default access level (Phalcon\Acl::ALLOW or Phalcon\Acl::DENY)
     *
     * @param int $defaultAccess 
     */
	public function setDefaultAction($defaultAccess);

    /**
     * Returns the default ACL access level
     *
     * @return int 
     */
	public function getDefaultAction();

    /**
     * Adds a role to the ACL list. Second parameter lets to inherit access data from other existing role
     *
     * @param mixed $role 
     * @param mixed $accessInherits 
     * @return bool 
     */
	public function addRole($role, $accessInherits = null);

    /**
     * Do a role inherit from another existing role
     *
     * @param string $roleName 
     * @param mixed $roleToInherit 
     */
	public function addInherit($roleName, $roleToInherit);

    /**
     * Check whether role exist in the roles list
     *
     * @param string $roleName 
     * @return bool 
     */
	public function isRole($roleName);

    /**
     * Check whether resource exist in the resources list
     *
     * @param string $resourceName 
     * @return bool 
     */
	public function isResource($resourceName);

    /**
     * Adds a resource to the ACL list
     * Access names can be a particular action, by example
     * search, update, delete, etc or a list of them
     *
     * @param mixed $resourceObject 
     * @param mixed $accessList 
     * @return bool 
     */
	public function addResource($resourceObject, $accessList = null);

    /**
     * Adds access to resources
     *
     * @param string $resourceName 
     * @param mixed $accessList 
     */
	public function addResourceAccess($resourceName, $accessList);

    /**
     * Removes an access from a resource
     *
     * @param string $resourceName 
     * @param mixed $accessList 
     */
	public function dropResourceAccess($resourceName, $accessList);

    /**
     * Allow access to a role on a resource
     *
     * @param string $roleName 
     * @param string $resourceName 
     * @param mixed $access 
     */
	public function allow($roleName, $resourceName, $access);

    /**
     * Deny access to a role on a resource
     *
     * @param string $roleName 
     * @param string $resourceName 
     * @param mixed $access 
     */
	public function deny($roleName, $resourceName, $access);

    /**
     * Check whether a role is allowed to access an action from a resource
     *
     * @param string $roleName 
     * @param string $resourceName 
     * @param mixed $access 
     * @return bool 
     */
	public function isAllowed($roleName, $resourceName, $access);

    /**
     * Returns the role which the list is checking if it's allowed to certain resource/access
     *
     * @return string 
     */
	public function getActiveRole();

    /**
     * Returns the resource which the list is checking if some role can access it
     *
     * @return string 
     */
	public function getActiveResource();

    /**
     * Returns the access which the list is checking if some role can access it
     *
     * @return string 
     */
	public function getActiveAccess();

    /**
     * Return an array with every role registered in the list
     *
     * @return \Phalcon\Acl\RoleInterface[] 
     */
	public function getRoles();

    /**
     * Return an array with every resource registered in the list
     *
     * @return \Phalcon\Acl\ResourceInterface[] 
     */
	public function getResources();

}
