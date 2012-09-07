<?php 

namespace Phalcon {

	/**
	 * Phalcon\Flash
	 *
	 * Shows HTML notifications related to different circumstances. Classes can be stylized using CSS
	 *
	 *<code>
	 * $flash->success("The record was successfully deleted");
	 * $flash->error("Cannot open the file");
	 *</code>
	 */
	
	abstract class Flash {

		protected $_cssClasses;

		protected $_implicitFlush;

		protected $_automaticHtml;

		public function __construct($cssClasses){ }


		public function setImplicitFlush($implicitFlush){ }


		public function setAutomaticHtml($automaticHtml){ }


		public function setCssClasses($cssClasses){ }


		/**
		 * Shows a HTML error message
		 *
		 * <code>$flash->error('This is an error'); </code>
		 *
		 * @param string $message
		 * @return string
		 */
		public function error($message){ }


		/**
		 * Shows a HTML notice/information message
		 *
		 * <code>$flash->notice('This is an information'); </code>
		 *
		 * @param string $message
		 * @return string
		 */
		public function notice($message){ }


		/**
		 * Shows a HTML success message
		 *
		 * <code>$flash->success('The process was finished successfully'); </code>
		 *
		 * @param string $message
		 * @param string $classes
		 * @return string
		 */
		public function success($message){ }


		/**
		 * Shows a HTML warning message
		 *
		 * <code>$flash->warning('Hey, this is important'); </code>
		 *
		 * @param string $message
		 * @param string $classes
		 * @return string
		 */
		public function warning($message){ }


		public function outputMessage($type, $message){ }

	}
}
