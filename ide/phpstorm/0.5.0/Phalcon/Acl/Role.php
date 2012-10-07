<?php 

namespace Phalcon\Acl {

	/**
	 *
	 * Phalcon\Acl\Role
	 *
	 * This class defines role entity and its description
	 *
	 */
	
	class Role {

		protected $_name;

		protected $_description;

		/**
		 * \Phalcon\Acl\Role description
		 *
		 * @param string $name
		 * @param string $description
		 */
		public function __construct($name, $description){ }


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

	}
}
