<?php 

namespace Phalcon {

	/**
	 * Phalcon\EscaperInterface initializer
	 */
	
	interface EscaperInterface {

		/**
		 * Sets the encoding to be used by the escaper
		 *
		 * @param string $encoding
		 */
		public function setEnconding($encoding);


		/**
		 * Returns the internal encoding used by the escaper
		 *
		 * @return string
		 */
		public function getEncoding();


		/**
		 * Sets the HTML quoting type for htmlspecialchars
		 *
		 * @param int $quoteType
		 */
		public function setHtmlQuoteType($quoteType);


		/**
		 * Escapes a HTML string
		 *
		 * @param string $text
		 * @return string
		 */
		public function escapeHtml($text);


		/**
		 * Escapes a HTML attribute string
		 *
		 * @param string $text
		 * @return string
		 */
		public function escapeHtmlAttr($text);


		/**
		 * Escape CSS strings by replacing non-alphanumeric chars by their hexadecimal representation
		 *
		 * @param string $css
		 * @return string
		 */
		public function escapeCss($css);


		/**
		 * Escapes a URL. Internally uses rawurlencode
		 *
		 * @param string $url
		 * @return string
		 */
		public function escapeUrl($url);

	}
}
