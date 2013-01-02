<?php 

namespace Phalcon {

	/**
	 * Phalcon\FlashInterface initializer
	 */
	
	interface FlashInterface {

		/**
		 * Shows a HTML error message
		 *
		 * @param string $message
		 * @return string
		 */
		public function error($message);


		/**
		 * Shows a HTML notice/information message
		 *
		 * @param string $message
		 * @return string
		 */
		public function notice($message);


		/**
		 * Shows a HTML success message
		 *
		 * @param string $message
		 * @return string
		 */
		public function success($message);


		/**
		 * Shows a HTML warning message
		 *
		 * @param string $message
		 * @return string
		 */
		public function warning($message);


		/**
		 * Outputs a message
		 *
		 * @param  string $type
		 * @param  string $message
		 * @return string
		 */
		public function message($type, $message);

	}
}
