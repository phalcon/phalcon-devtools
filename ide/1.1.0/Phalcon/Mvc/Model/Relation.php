<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Relation
	 *
	 * This class represents each relationship between two models
	 */
	
	class Relation implements \Phalcon\Mvc\Model\RelationInterface {

		const BELONGS_TO = 0;

		const HAS_ONE = 1;

		const HAS_MANY = 2;

		const HAS_ONE_THROUGH = 3;

		const HAS_MANY_THROUGH = 4;

		const MANY_TO_MANY = 3;

		protected $_type;

		protected $_referencedModel;

		protected $_fields;

		protected $_referencedFields;

		protected $_options;

		/**
		 * \Phalcon\Mvc\Model\Relation constructor
		 *
		 * @param int $type
		 * @param string $referencedModel
		 * @param string|array $fields
		 * @param string|array $referencedFields
		 * @param array $options
		 */
		public function __construct($type, $referencedModel, $fields, $referencedFields, $options=null){ }


		/**
		 * Returns the relation's type
		 *
		 * @return int
		 */
		public function getType(){ }


		/**
		 * Returns the referenced model
		 *
		 * @return string
		 */
		public function getReferencedModel(){ }


		/**
		 * Returns the fields
		 *
		 * @return string|array
		 */
		public function getFields(){ }


		/**
		 * Returns the referenced fields
		 *
		 * @return string|array
		 */
		public function getReferencedFields(){ }


		/**
		 * Returns the options
		 *
		 * @return string|array
		 */
		public function getOptions(){ }


		/**
		 * Check whether the relation act as a foreign key
		 *
		 * @return string|array
		 */
		public function isForeignKey(){ }


		/**
		 * Returns the foreign key configuration
		 *
		 * @return string|array
		 */
		public function getForeignKey(){ }


		/**
		 * Check whether the relation
		 *
		 * @return boolean
		 */
		public function hasThrough(){ }


		/**
		 * Returns the 'through' relation if any
		 *
		 * @return string
		 */
		public function getThrough(){ }


		/**
		 * Check if records in belongs-to/has-many are implicitly cached during the current request
		 *
		 * @return boolean
		 */
		public function isReusable(){ }

	}
}
