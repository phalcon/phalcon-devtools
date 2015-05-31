<?php 

namespace Phalcon\Acl {

	/**
	 * Phalcon\Acl\Resource
	 *
	 * This class defines resource entity and its description
	 */
	
	class Resource {

		protected $_name;

		protected $_description;

		/**
		 * Resource name
		 * @var string
		 */
		public function getName(){ }


		/**
		 * Resource name
		 * @var string
		 */
		public function __toString(){ }


		/**
		 * Resource description
		 * @var string
		 */
		public function getDescription(){ }


		/**
		 * \Phalcon\Acl\Resource constructor
		 */
		public function __construct($name, $description=null){ }

	}
}
