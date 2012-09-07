<?php 

namespace Phalcon\Flash {

	/**
	 * Phalcon\Flash\Direct
	 *
	 * This is a variant of the Phalcon\Flash that inmediately flush to the output any message passed to it
	 */
	
	class Direct extends \Phalcon\Flash {

		protected $_cssClasses;

		protected $_implicitFlush;

		protected $_automaticHtml;

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
