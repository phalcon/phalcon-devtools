<?php 

namespace Phalcon {

	/**
	 * Phalcon\FilterInterface initializer
	 */
	
	interface FilterInterface {

		/**
		 * Adds a user-defined filter
		 *
		 * @param string $name
		 * @param callable $handler
		 * @return \Phalcon\FilterInterface
		 */
		public function add($name, $handler);


		/**
		 * Sanizites a value with a specified single or set of filters
		 *
		 * @param  mixed $value
		 * @param  mixed $filters
		 * @return mixed
		 */
		public function sanitize($value, $filters);


		/**
		 * Return the user-defined filters in the instance
		 *
		 * @return object[]
		 */
		public function getFilters();

	}
}
