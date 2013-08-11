<?php 

namespace Phalcon\Logger {

	/**
	 * Phalcon\Logger\Formatter
	 *
	 * This is a base class for logger formatters
	 */
	
	abstract class Formatter {

		/**
		 * Returns the string meaning of a logger constant
		 *
		 * @param  integer $type
		 * @return string
		 */
		public function getTypeString($type){ }

	}
}
