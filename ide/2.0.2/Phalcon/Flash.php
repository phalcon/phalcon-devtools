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

		/**
		 * \Phalcon\Flash constructor
		 */
		public function __construct($cssClasses=null){ }


		/**
		 * Set whether the output must be implicitly flushed to the output or returned as string
		 */
		public function setImplicitFlush($implicitFlush){ }


		/**
		 * Set if the output must be implicitly formatted with HTML
		 */
		public function setAutomaticHtml($automaticHtml){ }


		/**
		 * Set an array with CSS classes to format the messages
		 */
		public function setCssClasses($cssClasses){ }


		/**
		 * Shows a HTML error message
		 *
		 *<code>
		 * $flash->error('This is an error');
		 *</code>
		 */
		public function error($message){ }


		/**
		 * Shows a HTML notice/information message
		 *
		 *<code>
		 * $flash->notice('This is an information');
		 *</code>
		 */
		public function notice($message){ }


		/**
		 * Shows a HTML success message
		 *
		 *<code>
		 * $flash->success('The process was finished successfully');
		 *</code>
		 */
		public function success($message){ }


		/**
		 * Shows a HTML warning message
		 *
		 *<code>
		 * $flash->warning('Hey, this is important');
		 *</code>
		 */
		public function warning($message){ }


		/**
		 * Outputs a message formatting it with HTML
		 *
		 *<code>
		 * $flash->outputMessage('error', message);
		 *</code>
		 *
		 * @param string|array message
		 */
		public function outputMessage($type, $message){ }

	}
}
