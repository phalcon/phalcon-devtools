<?php 

namespace Phalcon\Filter {

	/**
	 * Phalcon\Filter\UserFilterInterface initializer
	 */
	
	interface UserFilterInterface {

		/**
		 * Filters a value
		 *
		 * @param mixed $value
		 * @return mixed
		 */
		public function filter($value);

	}
}
