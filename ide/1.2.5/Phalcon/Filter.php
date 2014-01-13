<?php 

namespace Phalcon {

	/**
	 * Phalcon\Filter
	 *
	 * The Phalcon\Filter component provides a set of commonly needed data filters. It provides
	 * object oriented wrappers to the php filter extension. Also allows the developer to
	 * define his/her own filters
	 *
	 *<code>
	 *	$filter = new Phalcon\Filter();
	 *	$filter->sanitize("some(one)@exa\\mple.com", "email"); // returns "someone@example.com"
	 *	$filter->sanitize("hello<<", "string"); // returns "hello"
	 *	$filter->sanitize("!100a019", "int"); // returns "100019"
	 *	$filter->sanitize("!100a019.01a", "float"); // returns "100019.01"
	 *</code>
	 */
	
	class Filter implements \Phalcon\FilterInterface {

		protected $_filters;

		/**
		 * Adds a user-defined filter
		 *
		 * @param string $name
		 * @param callable $handler
		 * @return \Phalcon\Filter
		 */
		public function add($name, $handler){ }


		/**
		 * Sanitizes a value with a specified single or set of filters
		 *
		 * @param  mixed $value
		 * @param  mixed $filters
		 * @return mixed
		 */
		public function sanitize($value, $filters){ }


		/**
		 * Internal sanitize wrapper to filter_var
		 *
		 * @param  mixed $value
		 * @param  string $filter
		 * @return mixed
		 */
		protected function _sanitize(){ }


		/**
		 * Return the user-defined filters in the instance
		 *
		 * @return object[]
		 */
		public function getFilters(){ }

	}
}
