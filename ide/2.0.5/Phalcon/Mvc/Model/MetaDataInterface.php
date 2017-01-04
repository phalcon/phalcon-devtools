<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\MetaData\StrategyInterface;


interface MetaDataInterface
{

	/**
	 * Set the meta-data extraction strategy
	 * 
	 * @param StrategyInterface $strategy
	 */
	public function setStrategy(StrategyInterface $strategy);

	/**
	 * Return the strategy to obtain the meta-data
	 *
	 * @return Phalcon\Mvc\Model\MetaData\StrategyInterface
	 */
	public function getStrategy();

	/**
	 * Reads meta-data for certain model
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function readMetaData(ModelInterface $model);

	/**
	 * Reads meta-data for certain model using a MODEL_* constant
	 *
	 * @param ModelInterface $model
	 * @param int $index
	 * 
	 * @return mixed
	 */
	public function readMetaDataIndex(ModelInterface $model, $index);

	/**
	 * Writes meta-data for certain model using a MODEL_* constant
	 * 
	 * @param ModelInterface $model
	 * @param int $index
	 * @param mixed $data
	 *
	 */
	public function writeMetaDataIndex(ModelInterface $model, $index, $data);

	/**
	 * Reads the ordered/reversed column map for certain model
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function readColumnMap(ModelInterface $model);

	/**
	 * Reads column-map information for certain model using a MODEL_* constant
	 * 
	 * @param ModelInterface $model
	 * @param int $index
	 *
	 */
	public function readColumnMapIndex(ModelInterface $model, $index);

	/**
	 * Returns table attributes names (fields)
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getAttributes(ModelInterface $model);

	/**
	 * Returns an array of fields which are part of the primary key
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getPrimaryKeyAttributes(ModelInterface $model);

	/**
	 * Returns an arrau of fields which are not part of the primary key
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getNonPrimaryKeyAttributes(ModelInterface $model);

	/**
	 * Returns an array of not null attributes
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getNotNullAttributes(ModelInterface $model);

	/**
	 * Returns attributes and their data types
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getDataTypes(ModelInterface $model);

	/**
	 * Returns attributes which types are numerical
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getDataTypesNumeric(ModelInterface $model);

	/**
	 * Returns the name of identity field (if one is present)
	 *
	 * @param ModelInterface $model
	 * 
	 * @return string
	 */
	public function getIdentityField(ModelInterface $model);

	/**
	 * Returns attributes and their bind data types
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getBindTypes(ModelInterface $model);

	/**
	 * Returns attributes that must be ignored from the INSERT SQL generation
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getAutomaticCreateAttributes(ModelInterface $model);

	/**
	 * Returns attributes that must be ignored from the UPDATE SQL generation
	 *
	 * @param ModelInterface $model
	 * 
	 * @return array
	 */
	public function getAutomaticUpdateAttributes(ModelInterface $model);

	/**
	 * Set the attributes that must be ignored from the INSERT SQL generation
	 * 
	 * @param ModelInterface $model
	 * @param array $attributes
	 */
	public function setAutomaticCreateAttributes(ModelInterface $model, array $attributes);

	/**
	 * Set the attributes that must be ignored from the UPDATE SQL generation
	 * 
	 * @param ModelInterface $model
	 * @param array $attributes
	 */
	public function setAutomaticUpdateAttributes(ModelInterface $model, array $attributes);

	/**
	 * Set the attributes that allow empty string values
	 * 
	 * @param ModelInterface $model
	 * @param array $attributes	 
	 *
	 * @return void
	 */
	public function setEmptyStringAttributes(ModelInterface $model, array $attributes);

	/**
	 * Returns attributes allow empty strings
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getEmptyStringAttributes(ModelInterface $model);

	/**
	 * Returns attributes (which have default values) and their default values
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getDefaultValues(ModelInterface $model);

	/**
	 * Returns the column map if any
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getColumnMap(ModelInterface $model);

	/**
	 * Returns the reverse column map if any
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getReverseColumnMap(ModelInterface $model);

	/**
	 * Check if a model has certain attribute
	 * 
	 * @param ModelInterface $model
	 * @param string $attribute
	 *
	 * @return boolean
	 */
	public function hasAttribute(ModelInterface $model, $attribute);

	/**
	 * Checks if the internal meta-data container is empty
	 *
	 * @return boolean
	 */
	public function isEmpty();

	/**
	 * Resets internal meta-data in order to regenerate it
	 */
	public function reset();

	/**
	 * Reads meta-data from the adapter
	 *
	 * @param string $key
	 * 
	 * @return array
	 */
	public function read($key);

	/**
	 * Writes meta-data to the adapter
	 * 
	 * @param string $key
	 * @param array $data
	 *
	 */
	public function write($key, $data);

}
