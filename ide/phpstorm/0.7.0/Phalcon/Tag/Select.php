<?php 

namespace Phalcon\Tag {

	/**
	 * Phalcon\Tag\Select
	 *
	 * Generates a SELECT html tag using a static array of values or a Phalcon\Mvc\Model resultset
	 */
	
	class Select {

		/**
		 * Generates a SELECT tag
		 *
		 * @param array $parameters
		 * @param array $data
		 */
		public static function selectField($parameters, $data=null){ }


		/**
		 * Generate the OPTION tags based on the rows
		 *
		 * @param \Phalcon\Mvc\Model $resultset
		 * @param array $using
		 * @param mixed value
		 * @param string $closeOption
		 */
		protected static function _optionsFromResultset(){ }


		protected static function _optionsFromArray(){ }

	}
}
