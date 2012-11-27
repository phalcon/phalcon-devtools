<?php 

namespace Phalcon {

	/**
	 * Phalcon\Escaper
	 *
	 * Escapes different kinds of text securing them. By using this component you may
	 * prevent XSS attacks.
	 *
	 * This component only works with UTF-8. The PREG extension needs to be compiled with UTF-8 support.
	 *
	 *<code>
	 * $escaper = new Phalcon\Escaper();
	 * $escaped = $escaper->escapeCss("font-family: <Verdana>");
	 * echo $escaped; // font\2D family\3A \20 \3C Verdana\3E
	 *</code>
	 */
	
	class Escaper {

		protected $_encoding;

		protected $_htmlEscapeMap;

		protected $_htmlQuoteType;

		/**
		 * Sets the encoding to be used by the escaper
		 *
		 * @param string $encoding
		 */
		public function setEnconding($encoding){ }


		/**
		 * Returns the internal encoding used by the escaper
		 *
		 * @return string
		 */
		public function getEncoding(){ }


		/**
		 * Sets the HTML quoting type for htmlspecialchars
		 *
		 * @param int $quoteType
		 */
		public function setHtmlQuoteType($quoteType){ }


		/**
		 * Escapes a HTML string. Internally uses htmlspeciarchars
		 *
		 * @param string $text
		 * @return string
		 */
		public function escapeHtml($text){ }


		/**
		 * Escapes a HTML attribute string
		 *
		 * @param string $text
		 * @return string
		 */
		public function escapeHtmlAttr($text){ }


		/**
		 * Sanitizes CSS strings converting non-alphanumeric chars to their hexadecimal representation
		 *
		 * @param array $matches
		 * @return string
		 */
		public function cssSanitize($matches){ }


		/**
		 * Escape CSS strings by replacing non-alphanumeric chars by their hexadecimal representation
		 *
		 * @param string $css
		 */
		public function escapeCss($css){ }


		/**
		 * Escapes a URL. Internally uses rawurlencode
		 *
		 * @param string $url
		 * @return string
		 */
		public function escapeUrl($url){ }

	}
}
