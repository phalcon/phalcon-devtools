<?php 

namespace Phalcon\Assets {

	/**
	 * Phalcon\Assets\FilterInterface initializer
	 */
	
	interface FilterInterface {

		/**
		 * Filters the content returning a string with the filtered content
		 *
		 * @param string $content
		 * @return $content
		 */
		public function filter($content);

	}
}
