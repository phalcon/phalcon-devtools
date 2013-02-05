<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\RelationInterface initializer
	 */
	
	interface RelationInterface {

		/**
		 * \Phalcon\Mvc\Model\Relation constructor
		 *
		 * @param int $type
		 * @param string $referencedModel
		 * @param string|array $fields
		 * @param string|array $referencedFields
		 * @param array $options
		 */
		public function __construct($type, $referencedModel, $fields, $referencedFields, $options=null);


		/**
		 * Returns the relation's type
		 *
		 * @return int
		 */
		public function getType();


		/**
		 * Returns the referenced model
		 *
		 * @return string
		 */
		public function getReferencedModel();


		/**
		 * Returns the fields
		 *
		 * @return string|array
		 */
		public function getFields();


		/**
		 * Returns the referenced fields
		 *
		 * @return string|array
		 */
		public function getReferencedFields();


		/**
		 * Returns the options
		 *
		 * @return string|array
		 */
		public function getOptions();


		/**
		 * Check whether the relation act as a foreign key
		 *
		 * @return string|array
		 */
		public function isForeingKey();


		/**
		 * Returns the foreign key configuration
		 *
		 * @return string|array
		 */
		public function getForeignKey();


		/**
		 * Check whether the relation
		 *
		 * @return boolean
		 */
		public function hasThrough();


		/**
		 * Returns the 'through' relation if any
		 *
		 * @return string
		 */
		public function getThrough();

	}
}
