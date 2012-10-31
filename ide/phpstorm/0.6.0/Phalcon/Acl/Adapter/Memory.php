<?php 

namespace Phalcon\Acl\Adapter {

	/**
	 * Phalcon\Acl\Adapter\Memory
	 *
	 * Manages ACL lists in memory
	 *
	 *<code>
	 *
	 *	$acl = new Phalcon\Acl\Adapter\Memory();
	 *
	 *	$acl->setDefaultAction(Phalcon\Acl::DENY);
	 *
	 *	//Register roles
	 *	$roles = array(
	 *		'users' => new Phalcon\Acl\Role('Users'),
	 *		'guests' => new Phalcon\Acl\Role('Guests')
	 *	);
	 *	foreach($roles as $role){
	 *		$acl->addRole($role);
	 *	}
	 *
	 *	//Private area resources
	 *  $privateResources = array(
	 *		'companies' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
	 *		'products' => array('index', 'search', 'new', 'edit', 'save', 'create', 'delete'),
	 *		'invoices' => array('index', 'profile')
	 *	);
	 *	foreach($privateResources as $resource => $actions){
	 *		$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
	 *	}
	 *
	 *	//Private area resources
	 *	$publicResources = array(
	 *		'index' => array('index'),
	 *		'about' => array('index'),
	 *		'session' => array('index', 'register', 'start', 'end'),
	 *		'contact' => array('index', 'send')
	 *	);
	 *  foreach($publicResources as $resource => $actions){
	 *		$acl->addResource(new Phalcon\Acl\Resource($resource), $actions);
	 *	}
	 *
	 *  //Grant access to public areas to both users and guests
	 *	foreach($roles as $role){
	 *		foreach($publicResources as $resource => $actions){
	 *			$acl->allow($role->getName(), $resource, '*');
	 *		}
	 *	}
	 *
	 *	//Grant acess to private area to role Users
	 *  foreach($privateResources as $resource => $actions){
	 * 		foreach($actions as $action){
	 *			$acl->allow('Users', $resource, $action);
	 *		}
	 *	}
	 *
	 *</code>
	 */
	
	class Memory extends \Phalcon\Acl {

		const ALLOW = 1;

		const DENY = 0;

		protected $_rolesNames;

		protected $_roles;

		protected $_resources;

		protected $_access;

		protected $_roleInherits;

		protected $_resourcesNames;

		protected $_accessList;

		protected $_activeRole;

		protected $_activeResource;

		protected $_activeAccess;

		protected $_accessGranted;

		protected $_defaultAccess;

		public function __construct(){ }


		/**
		 * Sets the default access level (Phalcon\Acl::ALLOW or \Phalcon\Acl::DENY)
		 *
		 * @param int $defaultAccess
		 */
		public function setDefaultAction($defaultAccess){ }


		/**
		 * Returns the default ACL access level
		 */
		public function getDefaultAction(){ }


		/**
		 * Adds a role to the ACL list. Second parameter lets to inherit access data from other existing role
		 *
		 * Example:
		 * <code>
		 * $acl->addRole(new \Phalcon\Acl\Role('administrator'), 'consultant');
		 * $acl->addRole('administrator', 'consultant');
		 * </code>
		 *
		 * @param  string $roleObject
		 * @param  array $accessInherits
		 * @return boolean
		 */
		public function addRole($roleObject, $accessInherits=null){ }


		/**
		 * Do a role inherit from another existing role
		 *
		 * @param string $roleName
		 * @param string $roleToInherit
		 */
		public function addInherit($roleName, $roleToInherit){ }


		/**
		 * Check whether role exist in the roles list
		 *
		 * @param  string $roleName
		 * @return boolean
		 */
		public function isRole($roleName){ }


		/**
		 * Check whether resource exist in the resources list
		 *
		 * @param  string $resourceName
		 * @return boolean
		 */
		public function isResource($resourceName){ }


		/**
		 * Adds a resource to the ACL list
		 *
		 * Access names can be a particular action, by example
		 * search, update, delete, etc or a list of them
		 *
		 * Example:
		 * <code>
		 * //Add a resource to the the list allowing access to an action
		 * $acl->addResource(new \Phalcon\Acl\Resource('customers'), 'search');
		 * $acl->addResource('customers', 'search');
		 *
		 * //Add a resource  with an access list
		 * $acl->addResource(new \Phalcon\Acl\Resource('customers'), array('create', 'search'));
		 * $acl->addResource('customers', array('create', 'search'));
		 * </code>
		 *
		 * @param   \Phalcon\Acl\Resource $resource
		 * @return  boolean
		 */
		public function addResource($resource, $accessList=null){ }


		/**
		 * Adds access to resources
		 *
		 * @param string $resourceName
		 * @param mixed $accessList
		 */
		public function addResourceAccess($resourceName, $accessList){ }


		/**
		 * Removes an access from a resource
		 *
		 * @param string $resourceName
		 * @param mixed $accessList
		 */
		public function dropResourceAccess($resourceName, $accessList){ }


		protected function _allowOrDeny(){ }


		/**
		 * Allow access to a role on a resource
		 *
		 * You can use '*' as wildcard
		 *
		 * Example:
		 * <code>
		 * //Allow access to guests to search on customers
		 * $acl->allow('guests', 'customers', 'search');
		 *
		 * //Allow access to guests to search or create on customers
		 * $acl->allow('guests', 'customers', array('search', 'create'));
		 *
		 * //Allow access to any role to browse on products
		 * $acl->allow('*', 'products', 'browse');
		 *
		 * //Allow access to any role to browse on any resource
		 * $acl->allow('*', '*', 'browse');
		 * </code>
		 *
		 * @param string $roleName
		 * @param string $resourceName
		 * @param mixed $access
		 */
		public function allow($roleName, $resourceName, $access){ }


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
		 * @return boolean
		 */
		public function deny($roleName, $resourceName, $access){ }


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
		 * @param  string $role
		 * @param  string $resource
		 * @param  string $accessList
		 * @return boolean
		 */
		public function isAllowed($role, $resource, $access){ }


		/**
		 * Returns the role which the list is checking if it's allowed to certain resource/access
		 *
		 * @return string
		 */
		public function getActiveRole(){ }


		/**
		 * Returns the resource which the list is checking if some role can access it
		 *
		 * @return string
		 */
		public function getActiveResource(){ }


		/**
		 * Returns the access which the list is checking if some role can access it
		 *
		 * @return string
		 */
		public function getActiveAccess(){ }


		/**
		 * Rebuild the list of access from the inherit lists
		 *
		 */
		protected function _rebuildAccessList(){ }

	}
}
