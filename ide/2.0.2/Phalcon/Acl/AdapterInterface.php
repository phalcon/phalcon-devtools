<?php 

namespace Phalcon\Acl {

	interface AdapterInterface {

		public function setDefaultAction($defaultAccess);


		public function getDefaultAction();


		public function addRole($role, $accessInherits=null);


		public function addInherit($roleName, $roleToInherit);


		public function isRole($roleName);


		public function isResource($resourceName);


		public function addResource($resourceObject, $accessList);


		public function addResourceAccess($resourceName, $accessList);


		public function dropResourceAccess($resourceName, $accessList);


		public function allow($roleName, $resourceName, $access);


		public function deny($roleName, $resourceName, $access);


		public function isAllowed($roleName, $resourceName, $access);


		public function getActiveRole();


		public function getActiveResource();


		public function getActiveAccess();


		public function getRoles();


		public function getResources();

	}
}
