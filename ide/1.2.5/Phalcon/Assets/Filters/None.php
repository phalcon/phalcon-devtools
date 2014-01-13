<?php 

namespace Phalcon\Assets\Filters {

	/**
	 * Phalcon\Assets\Filters\None
	 *
	 * Returns the content without make any modification to the original source
	 */
	
	class None {

		/**
		 * Returns the content without be touched
		 *
		 * @param string $content
		 * @return $content
		 */
		public function filter($content){ }

	}
}
