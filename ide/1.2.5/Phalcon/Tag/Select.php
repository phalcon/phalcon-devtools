<?php 

namespace Phalcon\Tag {

	/**
	 * Phalcon\Tag\Select
	 *
	 * Generates a SELECT html tag using a static array of values or a Phalcon\Mvc\Model resultset
	 */
	
	abstract class Select {

		/**
		 * Generates a SELECT tag
		 *
		 * @param array $parameters
		 * @param array $data
		 */
		public static function selectField($parameters, $data=null){ }


		/**
		 * Generate the OPTION tags based on a resulset
		 *
		 * @param \Phalcon\Mvc\Model $resultset
		 * @param array $using
		 * @param mixed value
		 * @param string $closeOption
		 */
		protected static function _optionsFromResultset(){ }


		/**
		 * Generate the OPTION tags based on an array
		 *
		 * @param \Phalcon\Mvc\ModelInterface $resultset
		 * @param array $using
		 * @param mixed value
		 * @param string $closeOption
		 */
		protected static function _optionsFromArray(){ }

	}
}
