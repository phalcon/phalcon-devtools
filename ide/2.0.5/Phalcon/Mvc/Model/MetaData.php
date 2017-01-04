<?php

namespace Phalcon\Mvc\Model;

use Phalcon\DiInterface;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Model\MetaData\Strategy\Introspection;
use Phalcon\Mvc\Model\MetaData\StrategyInterface;


abstract class MetaData implements InjectionAwareInterface
{

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

	const MODELS_DEFAULT_VALUES = 12;

	const MODELS_EMPTY_STRING_VALUES = 13;

	const MODELS_COLUMN_MAP = 0;

	const MODELS_REVERSE_COLUMN_MAP = 1;



	protected $_dependencyInjector;

	protected $_strategy;

	protected $_metaData;

	protected $_columnMap;



	/**
	 * Initialize the metadata for certain table
	 * 
	 * @param ModelInterface $model
	 * @param mixed $key
	 * @param mixed $table
	 * @param mixed $schema
	 *
	 * @return mixed
	 */
	protected final function _initialize(ModelInterface $model, $key, $table, $schema) {}

	/**
				 * The meta-data is read from the adapter always if not available in _metaData property
	 * 
	 * @param DiInterface $dependencyInjector
				 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the DependencyInjector container
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Set the meta-data extraction strategy
	 * 
	 * @param StrategyInterface $strategy
	 *
	 * @return void
	 */
	public function setStrategy(StrategyInterface $strategy) {}

	/**
	 * Return the strategy to obtain the meta-data
	 *
	 * @return StrategyInterface
	 */
	public function getStrategy() {}

	/**
	 * Reads the complete meta-data for certain model
	 *
	 *<code>
	 *	print_r($metaData->readMetaData(new Robots());
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return mixed
	 */
	public final function readMetaData(ModelInterface $model) {}

	/**
	 * Reads meta-data for certain model
	 *
	 *<code>
	 *	print_r($metaData->readMetaDataIndex(new Robots(), 0);
	 *</code>
	 * 
	 * @param ModelInterface $model
	 * @param int $index
	 *
	 * @return mixed
	 */
	public final function readMetaDataIndex(ModelInterface $model, $index) {}

	/**
	 * Writes meta-data for certain model using a MODEL_* constant
	 *
	 *<code>
	 *	print_r($metaData->writeColumnMapIndex(new Robots(), MetaData::MODELS_REVERSE_COLUMN_MAP, array('leName' => 'name')));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 * @param int $index
	 * @param mixed $data
	 *
	 * @return void
	 */
	public final function writeMetaDataIndex(ModelInterface $model, $index, $data) {}

	/**
	 * Reads the ordered/reversed column map for certain model
	 *
	 *<code>
	 *	print_r($metaData->readColumnMap(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return mixed
	 */
	public final function readColumnMap(ModelInterface $model) {}

	/**
	 * Reads column-map information for certain model using a MODEL_* constant
	 *
	 *<code>
	 *	print_r($metaData->readColumnMapIndex(new Robots(), MetaData::MODELS_REVERSE_COLUMN_MAP));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 * @param int $index
	 *
	 * @return mixed
	 */
	public final function readColumnMapIndex(ModelInterface $model, $index) {}

	/**
	 * Returns table attributes names (fields)
	 *
	 *<code>
	 *	print_r($metaData->getAttributes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getAttributes(ModelInterface $model) {}

	/**
	 * Returns an array of fields which are part of the primary key
	 *
	 *<code>
	 *	print_r($metaData->getPrimaryKeyAttributes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getPrimaryKeyAttributes(ModelInterface $model) {}

	/**
	 * Returns an array of fields which are not part of the primary key
	 *
	 *<code>
	 *	print_r($metaData->getNonPrimaryKeyAttributes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getNonPrimaryKeyAttributes(ModelInterface $model) {}

	/**
	 * Returns an array of not null attributes
	 *
	 *<code>
	 *	print_r($metaData->getNotNullAttributes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getNotNullAttributes(ModelInterface $model) {}

	/**
	 * Returns attributes and their data types
	 *
	 *<code>
	 *	print_r($metaData->getDataTypes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getDataTypes(ModelInterface $model) {}

	/**
	 * Returns attributes which types are numerical
	 *
	 *<code>
	 *	print_r($metaData->getDataTypesNumeric(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getDataTypesNumeric(ModelInterface $model) {}

	/**
	 * Returns the name of identity field (if one is present)
	 *
	 *<code>
	 *	print_r($metaData->getIdentityField(new Robots()));
	 *</code>
	 *
	 * @param ModelInterface $model
	 * 
	 * @return mixed
	 */
	public function getIdentityField(ModelInterface $model) {}

	/**
	 * Returns attributes and their bind data types
	 *
	 *<code>
	 *	print_r($metaData->getBindTypes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getBindTypes(ModelInterface $model) {}

	/**
	 * Returns attributes that must be ignored from the INSERT SQL generation
	 *
	 *<code>
	 *	print_r($metaData->getAutomaticCreateAttributes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getAutomaticCreateAttributes(ModelInterface $model) {}

	/**
	 * Returns attributes that must be ignored from the UPDATE SQL generation
	 *
	 *<code>
	 *	print_r($metaData->getAutomaticUpdateAttributes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getAutomaticUpdateAttributes(ModelInterface $model) {}

	/**
	 * Set the attributes that must be ignored from the INSERT SQL generation
	 *
	 *<code>
	 *	$metaData->setAutomaticCreateAttributes(new Robots(), array('created_at' => true));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 * @param array $attributes
	 *
	 * @return void
	 */
	public function setAutomaticCreateAttributes(ModelInterface $model, array $attributes) {}

	/**
	 * Set the attributes that must be ignored from the UPDATE SQL generation
	 *
	 *<code>
	 *	$metaData->setAutomaticUpdateAttributes(new Robots(), array('modified_at' => true));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 * @param array $attributes
	 *
	 * @return void
	 */
	public function setAutomaticUpdateAttributes(ModelInterface $model, array $attributes) {}

	/**
	 * Set the attributes that allow empty string values
	 *
	 *<code>
	 *	$metaData->setEmptyStringAttributes(new Robots(), array('name' => true));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 * @param array $attributes
	 *
	 * @return void
	 */
	public function setEmptyStringAttributes(ModelInterface $model, array $attributes) {}

	/**
	 * Returns attributes allow empty strings
	 *
	 *<code>
	 *	print_r($metaData->getEmptyStringAttributes(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getEmptyStringAttributes(ModelInterface $model) {}

	/**
	 * Returns attributes (which have default values) and their default values
	 *
	 *<code>
	 *	print_r($metaData->getDefaultValues(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getDefaultValues(ModelInterface $model) {}

	/**
	 * Returns the column map if any
	 *
	 *<code>
	 *	print_r($metaData->getColumnMap(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getColumnMap(ModelInterface $model) {}

	/**
	 * Returns the reverse column map if any
	 *
	 *<code>
	 *	print_r($metaData->getReverseColumnMap(new Robots()));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 *
	 * @return array
	 */
	public function getReverseColumnMap(ModelInterface $model) {}

	/**
	 * Check if a model has certain attribute
	 *
	 *<code>
	 *	var_dump($metaData->hasAttribute(new Robots(), 'name'));
	 *</code>
	 * 
	 * @param ModelInterface $model
	 * @param string $attribute
	 *
	 * @return boolean
	 */
	public function hasAttribute(ModelInterface $model, $attribute) {}

	/**
	 * Checks if the internal meta-data container is empty
	 *
	 *<code>
	 *	var_dump($metaData->isEmpty());
	 *</code>
	 *
	 * @return boolean
	 */
	public function isEmpty() {}

	/**
	 * Resets internal meta-data in order to regenerate it
	 *
	 *<code>
	 *	$metaData->reset();
	 *</code>
	 *
	 * @return void
	 */
	public function reset() {}

}
