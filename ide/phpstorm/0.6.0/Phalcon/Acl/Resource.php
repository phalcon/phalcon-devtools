<?php 

namespace Phalcon\Acl {

	/**
	 *
	 * Phalcon\Acl\Resource
	 *
	 * This class defines resource entity and its description
	 *
	 */
	
	class Resource {

		protected $_name;

		protected $_description;

		/**
		 * \Phalcon\Acl\Resource description
		 *
		 * @param string $name
		 * @param string $description
		 */
		public function __construct($name, $description=null){ }


		/**
		 * Returns the resource name
		 *
		 * @return string
		 */
		public function getName(){ }


		/**
		 * Returns resource description
		 *
		 * @return string
		 */
		public function getDescription(){ }

	}
}
