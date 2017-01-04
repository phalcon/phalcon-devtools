<?php

namespace Phalcon;

use Phalcon\EscaperInterface;
use Phalcon\Escaper\Exception;


class Escaper implements EscaperInterface
{

	protected $_encoding = 'utf-8';

	protected $_htmlEscapeMap = null;

	protected $_htmlQuoteType = 3;



	/**
	 * Sets the encoding to be used by the escaper
	 *
	 *<code>
	 * $escaper->setEncoding('utf-8');
	 *</code>
	 * 
	 * @param string $encoding
	 *
	 * @return void
	 */
	public function setEncoding($encoding) {}

	/**
	 * Returns the internal encoding used by the escaper
	 *
	 * @return string
	 */
	public function getEncoding() {}

	/**
	 * Sets the HTML quoting type for htmlspecialchars
	 *
	 *<code>
	 * $escaper->setHtmlQuoteType(ENT_XHTML);
	 *</code>
	 * 
	 * @param int $quoteType
	 *
	 * @return void
	 */
	public function setHtmlQuoteType($quoteType) {}

	/**
	 * Detect the character encoding of a string to be handled by an encoder
	 * Special-handling for chr(172) and chr(128) to chr(159) which fail to be detected by mb_detect_encoding()
	 * 
	 * @param string $str
	 *
	 * @return string|null
	 */
	public final function detectEncoding($str) {}

	/**
		* Check if charset is ASCII or ISO-8859-1
	 * 
	 * @param string $str
		*
	 * @return string
	 */
	public final function normalizeEncoding($str) {}

	/**
		 * mbstring is required here
	 * 
	 * @param string $text
		 *
	 * @return string
	 */
	public function escapeHtml($text) {}

	/**
	 * Escapes a HTML attribute string
	 * 
	 * @param string $attribute
	 *
	 * @return string
	 */
	public function escapeHtmlAttr($attribute) {}

	/**
	 * Escape CSS strings by replacing non-alphanumeric chars by their hexadecimal escaped representation
	 * 
	 * @param string $css
	 *
	 * @return string
	 */
	public function escapeCss($css) {}

	/**
		 * Normalize encoding to UTF-32
		 * Escape the string
	 * 
	 * @param string $js
		 *
	 * @return string
	 */
	public function escapeJs($js) {}

	/**
		 * Normalize encoding to UTF-32
		 * Escape the string
	 * 
	 * @param string $url
		 *
	 * @return string
	 */
	public function escapeUrl($url) {}

}
