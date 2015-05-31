<?php 

namespace Phalcon\Acl {

	/**
	 * Phalcon\Acl\Role
	 *
	 * This class defines role entity and its description
	 */
	
	class Role implements \Phalcon\Acl\RoleInterface {

		protected $_name;

		protected $_description;

		/**
		 * Role name
		 * @var string
		 */
		public function getName(){ }


		/**
		 * Role name
		 * @var string
		 */
		public function __toString(){ }


		/**
		 * Role description
		 * @var string
		 */
		public function getDescription(){ }


		/**
		 * \Phalcon\Acl\Role constructor
		 */
		public function __construct($name, $description=null){ }

	}
}
