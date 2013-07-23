<?php 

namespace Phalcon\Acl {

	/**
	 * Phalcon\Acl\Role
	 *
	 * This class defines role entity and its description
	 *
	 */
	
	class Role implements \Phalcon\Acl\RoleInterface {

		protected $_name;

		protected $_description;

		/**
		 * \Phalcon\Acl\Role description
		 *
		 * @param string $name
		 * @param string $description
		 */
		public function __construct($name, $description=null){ }


		/**
		 * Returns the role name
		 *
		 * @return string
		 */
		public function getName(){ }


		/**
		 * Returns role description
		 *
		 * @return string
		 */
		public function getDescription(){ }


		/**
		 * Magic method __toString
		 *
		 * @return string
		 */
		public function __toString(){ }

	}
}
