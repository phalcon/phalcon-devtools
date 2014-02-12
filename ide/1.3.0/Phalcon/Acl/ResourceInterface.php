<?php 

namespace Phalcon\Acl {

	/**
	 * Phalcon\Acl\ResourceInterface initializer
	 */
	
	interface ResourceInterface {

		/**
		 * Returns the resource name
		 *
		 * @return string
		 */
		public function getName();


		/**
		 * Returns resource description
		 *
		 * @return string
		 */
		public function getDescription();

	}
}
