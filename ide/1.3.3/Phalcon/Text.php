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
		 *<code>
		 *	echo \Phalcon\Text::camelize('coco_bongo'); //CocoBongo
		 *</code>
		 *
		 * @param string $str
		 * @return string
		 */
		public static function camelize($str){ }


		/**
		 * Uncamelize strings which are camelized
		 *
		 *<code>
		 *	echo \Phalcon\Text::uncamelize('CocoBongo'); //coco_bongo
		 *</code>
		 *
		 * @param string $str
		 * @return string
		 */
		public static function uncamelize($str){ }


		/**
		 * Adds a number to a string or increment that number if it already is defined
		 *
		 *<code>
		 *	echo \Phalcon\Text::increment("a"); // "a_1"
		 *	echo \Phalcon\Text::increment("a_1"); // "a_2"
		 *</code>
		 *
		 * @param string $str
		 * @param string $separator
		 * @return string
		 */
		public static function increment($str, $separator=null){ }


		/**
		 * Generates a random string based on the given type. Type is one of the RANDOM_* constants
		 *
		 *<code>
		 *	echo \Phalcon\Text::random(Phalcon\Text::RANDOM_ALNUM); //"aloiwkqz"
		 *</code>
		 *
		 * @param int $type
		 * @param int $length
		 * @return string
		 */
		public static function random($type, $length=null){ }


		/**
		 * Check if a string starts with a given string
		 *
		 *<code>
		 *	echo \Phalcon\Text::startsWith("Hello", "He"); // true
		 *	echo \Phalcon\Text::startsWith("Hello", "he"); // false
		 *	echo \Phalcon\Text::startsWith("Hello", "he", false); // true
		 *</code>
		 *
		 * @param string $str
		 * @param string $start
		 * @param boolean $ignoreCase
		 * @return boolean
		 */
		public static function startsWith($str, $start, $ignoreCase=null){ }


		/**
		 * Check if a string ends with a given string
		 *
		 *<code>
		 *	echo \Phalcon\Text::endsWith("Hello", "llo"); // true
		 *	echo \Phalcon\Text::endsWith("Hello", "LLO"); // false
		 *	echo \Phalcon\Text::endsWith("Hello", "LLO", false); // true
		 *</code>
		 *
		 * @param string $str
		 * @param string $end
		 * @param boolean $ignoreCase
		 * @return boolean
		 */
		public static function endsWith($str, $end, $ignoreCase=null){ }


		/**
		 * Lowercases a string, this function makes use of the mbstring extension if available
		 *
		 * @param string $str
		 * @return string
		 */
		public static function lower($str){ }


		/**
		 * Uppercases a string, this function makes use of the mbstring extension if available
		 *
		 * @param string $str
		 * @return string
		 */
		public static function upper($str){ }

	}
}
