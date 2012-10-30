<?php 

namespace Phalcon\Flash {

	/**
	 * Phalcon\Flash\Direct
	 *
	 * This is a variant of the Phalcon\Flash that inmediately outputs any message passed to it
	 */
	
	class Direct extends \Phalcon\Flash {

		/**
		 * Outputs a message
		 *
		 * @param  string $type
		 * @param  string $message
		 * @return string
		 */
		public function message($type, $message){ }

	}
}
