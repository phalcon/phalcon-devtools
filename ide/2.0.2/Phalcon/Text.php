<?php 

namespace Phalcon {

	/**
	 * Phalcon\Text
	 *
	 * Provides utilities to work with texts
	 */
	
	abstract class Text {

		const RANDOM_ALNUM = 0;

		const RANDOM_ALPHA = 1;

		const RANDOM_HEXDEC = 2;

		const RANDOM_NUMERIC = 3;

		const RANDOM_NOZERO = 4;

		/**
		 * Converts strings to camelize style
		 *
		 * <code>
		 *    echo \Phalcon\Text::camelize('coco_bongo'); //CocoBongo
		 * </code>
		 */
		public static function camelize($str){ }


		/**
		 * Uncamelize strings which are camelized
		 *
		 * <code>
		 *    echo \Phalcon\Text::camelize('CocoBongo'); //coco_bongo
		 * </code>
		 */
		public static function uncamelize($str){ }


		/**
		 * Adds a number to a string or increment that number if it already is defined
		 *
		 * <code>
		 *    echo \Phalcon\Text::increment("a"); // "a_1"
		 *    echo \Phalcon\Text::increment("a_1"); // "a_2"
		 * </code>
		 */
		public static function increment($str, $separator=null){ }


		/**
		 * Generates a random string based on the given type. Type is one of the RANDOM_* constants
		 *
		 * <code>
		 *    echo \Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM); //"aloiwkqz"
		 * </code>
		 */
		public static function random($type=null, $length=null){ }


		/**
		 * Check if a string starts with a given string
		 *
		 * <code>
		 *    echo \Phalcon\Text::startsWith("Hello", "He"); // true
		 *    echo \Phalcon\Text::startsWith("Hello", "he", false); // false
		 *    echo \Phalcon\Text::startsWith("Hello", "he"); // true
		 * </code>
		 */
		public static function startsWith($str, $start, $ignoreCase=null){ }


		/**
		 * Check if a string ends with a given string
		 *
		 * <code>
		 *    echo \Phalcon\Text::endsWith("Hello", "llo"); // true
		 *    echo \Phalcon\Text::endsWith("Hello", "LLO", false); // false
		 *    echo \Phalcon\Text::endsWith("Hello", "LLO"); // true
		 * </code>
		 */
		public static function endsWith($str, $end, $ignoreCase=null){ }


		/**
		 * Lowercases a string, this function makes use of the mbstring extension if available
		 *
		 * <code>
		 *    echo \Phalcon\Text::lower("HELLO"); // hello
		 * </code>
		 */
		public static function lower($str, $encoding=null){ }


		/**
		 * Uppercases a string, this function makes use of the mbstring extension if available
		 *
		 * <code>
		 *    echo \Phalcon\Text::upper("hello"); // HELLO
		 * </code>
		 */
		public static function upper($str, $encoding=null){ }


		/**
		 * Reduces multiple slashes in a string to single slashes
		 *
		 * <code>
		 *    echo \Phalcon\Text::reduceSlashes("foo//bar/baz"); // foo/bar/baz
		 *    echo \Phalcon\Text::reduceSlashes("http://foo.bar///baz/buz"); // http://foo.bar/baz/buz
		 * </code>
		 */
		public static function reduceSlashes($str){ }


		/**
		 * Concatenates strings using the separator only once without duplication in places concatenation
		 *
		 * <code>
		 *    $str = \Phalcon\Text::concat("/", "/tmp/", "/folder_1/", "/folder_2", "folder_3/");
		 *    echo $str; // /tmp/folder_1/folder_2/folder_3/
		 * </code>
		 *
		 * @param string separator
		 * @param string a
		 * @param string b
		 * @param string ...N
		 */
		public static function concat(){ }

	}
}
