<?php 

namespace Phalcon\Acl {

	/**
	 * Phalcon\Acl\RoleInterface initializer
	 */
	
	interface RoleInterface {

		/**
		 * Returns the role name
		 *
		 * @return string
		 */
		public function getName();


		/**
		 * Returns role description
		 *
		 * @return string
		 */
		public function getDescription();

	}
}
