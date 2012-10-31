<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\MetaData
	 *
	 * <p>Because Phalcon\Mvc\Model requires meta-data like field names, data types, primary keys, etc.
	 * this component collect them and store for further querying by Phalcon\Model\Base.
	 * Phalcon\Mvc\Model\MetaData can also use adapters to store temporarily or permanently the meta-data.</p>
	 *
	 * <p>A standard Phalcon\Mvc\Model\MetaData can be used to query model attributes:</p>
	 *
	 * <code>
	 *	$metaData = new Phalcon\Mvc\Model\MetaData\Memory();
	 *	$attributes = $metaData->getAttributes(new Robots());
	 *	print_r($attributes);
	 * </code>
	 *
	 */
	
	abstract class MetaData {

		const MODELS_ATTRIBUTES = 0;

		const MODELS_PRIMARY_KEY = 1;

		const MODELS_NON_PRIMARY_KEY = 2;

		const MODELS_NOT_NULL = 3;

		const MODELS_DATA_TYPES = 4;

		const MODELS_DATA_TYPES_NUMERIC = 5;

		const MODELS_DATE_AT = 6;

		const MODELS_DATE_IN = 7;

		const MODELS_IDENTITY_COLUMN = 8;

		const MODELS_DATA_TYPES_BIND = 9;

		const MODELS_AUTOMATIC_DEFAULT_INSERT = 10;

		const MODELS_AUTOMATIC_DEFAULT_UPDATE = 11;

		protected $_metaData;

		/**
		 * Initialize the metadata for certain table
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @param string $key
		 * @param string $table
		 * @param string $schema
		 */
		protected function _initializeMetaData(){ }


		/**
		 * Reads meta-data for certain model using a MODEL_* constant
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @param int $index
		 */
		public function readMetaDataIndex($model, $index){ }


		/**
		 * Writes meta-data for certain model using a MODEL_* constant
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @param int $index
		 * @param mixed $data
		 */
		public function writeMetaDataIndex($model, $index, $data){ }


		/**
		 * Returns table attributes names (fields)
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @return 	array
		 */
		public function getAttributes($model){ }


		/**
		 * Returns an array of fields which are part of the primary key
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @return array
		 */
		public function getPrimaryKeyAttributes($model){ }


		/**
		 * Returns an arrau of fields which are not part of the primary key
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @return 	array
		 */
		public function getNonPrimaryKeyAttributes($model){ }


		/**
		 * Returns an array of not null attributes
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @return array
		 */
		public function getNotNullAttributes($model){ }


		/**
		 * Returns attributes and their data types
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @return array
		 */
		public function getDataTypes($model){ }


		/**
		 * Returns attributes which types are numerical
		 *
		 * @param  \Phalcon\Mvc\Model $model
		 * @return array
		 */
		public function getDataTypesNumeric($model){ }


		/**
		 * Returns the name of identity field (if one is present)
		 *
		 * @param  \Phalcon\Mvc\Model $model
		 * @return string
		 */
		public function getIdentityField($model){ }


		/**
		 * Returns attributes and their bind data types
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @return array
		 */
		public function getBindTypes($model){ }


		/**
		 * Returns attributes that must be ignored from the INSERT SQL generation
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @return array
		 */
		public function getAutomaticCreateAttributes($model){ }


		/**
		 * Returns attributes that must be ignored from the UPDATE SQL generation
		 *
		 * @param \Phalcon\Mvc\Model $model
		 * @return array
		 */
		public function getAutomaticUpdateAttributes($model){ }


		/**
		 * Set the attributes that must be ignored from the INSERT SQL generation
		 *
		 * @param  \Phalcon\Mvc\Model $model
		 * @param  array $attributes
		 */
		public function setAutomaticCreateAttributes($model, $attributes){ }


		/**
		 * Set the attributes that must be ignored from the UPDATE SQL generation
		 *
		 * @param  \Phalcon\Mvc\Model $model
		 * @param  array $attributes
		 */
		public function setAutomaticUpdateAttributes($model, $attributes){ }


		/**
		 * Checks if the internal meta-data container is empty
		 *
		 * @return boolean
		 */
		public function isEmpty(){ }


		/**
		 * Resets internal meta-data in order to regenerate it
		 */
		public function reset(){ }


		abstract public function read(){ }


		abstract public function write(){ }

	}
}
