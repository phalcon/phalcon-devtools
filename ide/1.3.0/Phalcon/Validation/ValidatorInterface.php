<?php 

namespace Phalcon\Validation {

	/**
	 * Phalcon\Validation\ValidatorInterface initializer
	 */
	
	interface ValidatorInterface {

		/**
		 * Checks if an option is defined
		 *
		 * @param string $key
		 * @return mixed
		 */
		public function isSetOption($key);


		/**
		 * Returns an option in the validator's options
		 * Returns null if the option hasn't been set
		 *
		 * @param string $key
		 * @return mixed
		 */
		public function getOption($key);


		/**
		 * Sets the validator's option
		 *
		 * @param string $key
		 * @param mixed $value
		 */
		public function setOption($key, $value);


		/**
		 * Executes the validation
		 *
		 * @param \Phalcon\Validator $validator
		 * @param string $attribute
		 * @return \Phalcon\Validation\Message\Group
		 */
		public function validate($validator, $attribute);

	}
}
