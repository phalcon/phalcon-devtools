<?php

namespace Phalcon;

abstract class Text
{

	const RANDOM_ALNUM = 0;

	const RANDOM_ALPHA = 1;

	const RANDOM_HEXDEC = 2;

	const RANDOM_NUMERIC = 3;

	const RANDOM_NOZERO = 4;



	/**
	 * Converts strings to camelize style
	 *
	 * <code>
	 *    echo Phalcon\Text::camelize('coco_bongo'); //CocoBongo
	 * </code>
	 * 
	 * @param string $str
	 *
	 * @return string
	 */
	public static function camelize($str) {}

	/**
	 * Uncamelize strings which are camelized
	 *
	 * <code>
	 *    echo Phalcon\Text::camelize('CocoBongo'); //coco_bongo
	 * </code>
	 * 
	 * @param string $str
	 *
	 * @return string
	 */
	public static function uncamelize($str) {}

	/**
	 * Adds a number to a string or increment that number if it already is defined
	 *
	 * <code>
	 *    echo Phalcon\Text::increment("a"); // "a_1"
	 *    echo Phalcon\Text::increment("a_1"); // "a_2"
	 * </code>
	 * 
	 * @param string $str
	 * @param mixed $separator
	 *
	 * @return string
	 */
	public static function increment($str, $separator=null) {}

	/**
	 * Generates a random string based on the given type. Type is one of the RANDOM_* constants
	 *
	 * <code>
	 *    echo Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM); //"aloiwkqz"
	 * </code>
	 * 
	 * @param int $type
	 * @param int $length
	 *
	 * @return string
	 */
	public static function random($type, $length=8) {}

	/**
	 * Check if a string starts with a given string
	 *
	 * <code>
	 *    echo Phalcon\Text::startsWith("Hello", "He"); // true
	 *    echo Phalcon\Text::startsWith("Hello", "he", false); // false
	 *    echo Phalcon\Text::startsWith("Hello", "he"); // true
	 * </code>
	 * 
	 * @param string $str
	 * @param string $start
	 * @param boolean $ignoreCase
	 *
	 * @return boolean
	 */
	public static function startsWith($str, $start, $ignoreCase=true) {}

	/**
	 * Check if a string ends with a given string
	 *
	 * <code>
	 *    echo Phalcon\Text::endsWith("Hello", "llo"); // true
	 *    echo Phalcon\Text::endsWith("Hello", "LLO", false); // false
	 *    echo Phalcon\Text::endsWith("Hello", "LLO"); // true
	 * </code>
	 * 
	 * @param string $str
	 * @param string $end
	 * @param boolean $ignoreCase
	 *
	 * @return boolean
	 */
	public static function endsWith($str, $end, $ignoreCase=true) {}

	/**
	 * Lowercases a string, this function makes use of the mbstring extension if available
	 *
	 * <code>
	 *    echo Phalcon\Text::lower("HELLO"); // hello
	 * </code>
	 * 
	 * @param string $str
	 * @param string $encoding
	 *
	 * @return string
	 */
	public static function lower($str, $encoding="UTF-8") {}

	/**
		 * 'lower' checks for the mbstring extension to make a correct lowercase transformation
	 * 
	 * @param string $str
	 * @param string $encoding
		 *
	 * @return string
	 */
	public static function upper($str, $encoding="UTF-8") {}

	/**
		 * 'upper' checks for the mbstring extension to make a correct lowercase transformation
	 * 
	 * @param string $str
		 *
	 * @return string
	 */
	public static function reduceSlashes($str) {}

	/**
	 * Concatenates strings using the separator only once without duplication in places concatenation
	 *
	 * <code>
	 *    $str = Phalcon\Text::concat("/", "/tmp/", "/folder_1/", "/folder_2", "folder_3/");
	 *    echo $str; // /tmp/folder_1/folder_2/folder_3/
	 * </code>
	 *
	 * @param string separator
	 * @param string a
	 * @param string b
	 * @param string ...N
	 *
	 * @return string
	 */
	public static function concat() {}

	/**
		 * TODO:
		 * Remove after solve https://github.com/phalcon/zephir/issues/938,
		 * and also replace line 214 to 213
	 * 
	 * @param string $text
	 * @param string $leftDelimiter
	 * @param string $rightDelimiter
	 * @param string $separator
		 *
	 * @return string
	 */
	public static function dynamic($text, $leftDelimiter="{", $rightDelimiter="}", $separator="|") {}

}
