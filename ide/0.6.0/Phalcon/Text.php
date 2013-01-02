<?php 

namespace Phalcon {

	/**
	 * Phalcon\Text
	 *
	 * Provides utilities when working with strings
	 */
	
	class Text {

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
		 *	echo \Phalcon\Text::camelize('CocoBongo'); //coco_bongo
		 *</code>
		 *
		 * @param string $str
		 * @return string
		 */
		public static function uncamelize($str){ }


		public static function x($a, $b){ }

	}
}
