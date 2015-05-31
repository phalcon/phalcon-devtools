<?php 

namespace Phalcon\Validation {

	interface ValidatorInterface {

		public function isSetOption($key);


		public function hasOption($key);


		public function getOption($key, $defaultValue=null);


		public function validate(\Phalcon\Validation $validation, $attribute);

	}
}
