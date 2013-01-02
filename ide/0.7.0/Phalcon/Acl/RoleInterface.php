<?php 

namespace Phalcon\Acl {

	/**
	 * Phalcon\Acl\RoleInterface initializer
	 */
	
	interface RoleInterface {

		/**
		 * \Phalcon\Acl\Role constructor
		 *
		 * @param string $name
		 * @param string $description
		 */
		public function __construct($name, $description=null);


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


		/**
		 * Magic method __toString
		 *
		 * @return string
		 */
		public function __toString();

	}
}
