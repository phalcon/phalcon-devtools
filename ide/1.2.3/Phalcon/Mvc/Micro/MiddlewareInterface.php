<?php 

namespace Phalcon\Mvc\Micro {

	/**
	 * Phalcon\Mvc\Micro\MiddlewareInterface initializer
	 */
	
	interface MiddlewareInterface {

		/**
		 * Calls the middleware
		 *
		 * @param \Phalcon\Mvc\Micro $application
		 */
		public function call($application);

	}
}
