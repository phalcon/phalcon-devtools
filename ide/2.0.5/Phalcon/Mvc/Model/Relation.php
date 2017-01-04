<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\Model\RelationInterface;


class Relation implements RelationInterface
{

	const BELONGS_TO = 0;

	const HAS_ONE = 1;

	const HAS_MANY = 2;

	const HAS_ONE_THROUGH = 3;

	const HAS_MANY_THROUGH = 4;

	const NO_ACTION = 0;

	const ACTION_RESTRICT = 1;

	const ACTION_CASCADE = 2;



	protected $_type;

	protected $_referencedModel;

	protected $_fields;

	protected $_referencedFields;

	protected $_intermediateModel;

	protected $_intermediateFields;

	protected $_intermediateReferencedFields;

	protected $_options;



	/**
	 * Phalcon\Mvc\Model\Relation constructor
	 * 
	 * @param int $type
	 * @param string $referencedModel
	 * @param mixed $fields
	 * @param mixed $referencedFields
	 * @param mixed $options
	 *
	 */
	public function __construct($type, $referencedModel, $fields, $referencedFields, $options=null) {}

	/**
	 * Sets the intermediate model data for has-*-through relations
	 * 
	 * @param string|array $intermediateFields
	 * @param string $intermediateModel
	 * @param string $intermediateReferencedFields
	 *
	 *
	 * @return void
	 */
	public function setIntermediateRelation($intermediateFields, $intermediateModel, $intermediateReferencedFields) {}

	/**
	 * Returns the relation type
	 *
	 * @return int
	 */
	public function getType() {}

	/**
	 * Returns the referenced model
	 *
	 * @return string
	 */
	public function getReferencedModel() {}

	/**
	 * Returns the fields
	 *
	 * @return mixed
	 */
	public function getFields() {}

	/**
	 * Returns the referenced fields
	 *
	 * @return mixed
	 */
	public function getReferencedFields() {}

	/**
	 * Returns the options
	 *
	 * @return mixed
	 */
	public function getOptions() {}

	/**
	 * Check whether the relation act as a foreign key
	 *
	 * @return boolean
	 */
	public function isForeignKey() {}

	/**
	 * Returns the foreign key configuration
	 *
	 * @return mixed
	 */
	public function getForeignKey() {}

	/**
	 * Returns parameters that must be always used when the related records are obtained
	 *
	 * @return mixed
	 */
	public function getParams() {}

	/**
	 * Check whether the relation is a 'many-to-many' relation or not
	 *
	 * @return boolean
	 */
	public function isThrough() {}

	/**
	 * Check if records returned by getting belongs-to/has-many are implicitly cached during the current request
	 *
	 * @return boolean
	 */
	public function isReusable() {}

	/**
	 * Gets the intermediate fields for has-*-through relations
	 *
	 * @return mixed
	 */
	public function getIntermediateFields() {}

	/**
	 * Gets the intermediate model for has-*-through relations
	 *
	 * @return string
	 */
	public function getIntermediateModel() {}

	/**
	 * Gets the intermediate referenced fields for has-*-through relations
	 *
	 * @return mixed
	 */
	public function getIntermediateReferencedFields() {}

}
