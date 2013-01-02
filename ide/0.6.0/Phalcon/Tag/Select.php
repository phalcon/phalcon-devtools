<?php 

namespace Phalcon\Tag {

	/**
	 * Phalcon\Tag\Select
	 *
	 * Generates a SELECT html tag using an static array of values or a Phalcon\Model resultset
	 */
	
	abstract class Select {

		/**
		 * Generates a SELECT tag
		 *
		 * @param array $parameters
		 * @param array $data
		 */
		public static function selectField($parameters, $data=null){ }


		protected static function _optionsFromResultset(){ }


		protected static function _optionsFromArray(){ }

	}
}
