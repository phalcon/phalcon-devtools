<?php

namespace Phalcon\Mvc\Model;

/**
 * Phalcon\Mvc\Model\MetaDataInterface
 * Interface for Phalcon\Mvc\Model\MetaData
 */
interface MetaDataInterface
{

    /**
     * Set the meta-data extraction strategy
     *
     * @param mixed $strategy 
     */
    public function setStrategy(\Phalcon\Mvc\Model\MetaData\StrategyInterface $strategy);

    /**
     * Return the strategy to obtain the meta-data
     *
     * @return \Phalcon\Mvc\Model\MetaData\StrategyInterface 
     */
    public function getStrategy();

    /**
     * Reads meta-data for certain model
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function readMetaData(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Reads meta-data for certain model using a MODEL_* constant
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @param int $index 
     * @return mixed 
     */
    public function readMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index);

    /**
     * Writes meta-data for certain model using a MODEL_* constant
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @param int $index 
     * @param mixed $data 
     */
    public function writeMetaDataIndex(\Phalcon\Mvc\ModelInterface $model, $index, $data);

    /**
     * Reads the ordered/reversed column map for certain model
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function readColumnMap(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Reads column-map information for certain model using a MODEL_* constant
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @param int $index 
     */
    public function readColumnMapIndex(\Phalcon\Mvc\ModelInterface $model, $index);

    /**
     * Returns table attributes names (fields)
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getAttributes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns an array of fields which are part of the primary key
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns an array of fields which are not part of the primary key
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getNonPrimaryKeyAttributes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns an array of not null attributes
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getNotNullAttributes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns attributes and their data types
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getDataTypes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns attributes which types are numerical
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getDataTypesNumeric(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns the name of identity field (if one is present)
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return string 
     */
    public function getIdentityField(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns attributes and their bind data types
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getBindTypes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns attributes that must be ignored from the INSERT SQL generation
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns attributes that must be ignored from the UPDATE SQL generation
     *
     * @param \Phalcon\Mvc\ModelInterface $model 
     * @return array 
     */
    public function getAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Set the attributes that must be ignored from the INSERT SQL generation
     *
     * @param mixed $model 
     * @param array $attributes 
     */
    public function setAutomaticCreateAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes);

    /**
     * Set the attributes that must be ignored from the UPDATE SQL generation
     *
     * @param mixed $model 
     * @param array $attributes 
     */
    public function setAutomaticUpdateAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes);

    /**
     * Set the attributes that allow empty string values
     *
     * @param mixed $model 
     * @param array $attributes 
     */
    public function setEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model, array $attributes);

    /**
     * Returns attributes allow empty strings
     *
     * @param mixed $model 
     * @return array 
     */
    public function getEmptyStringAttributes(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns attributes (which have default values) and their default values
     *
     * @param mixed $model 
     * @return array 
     */
    public function getDefaultValues(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns the column map if any
     *
     * @param mixed $model 
     * @return array 
     */
    public function getColumnMap(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Returns the reverse column map if any
     *
     * @param mixed $model 
     * @return array 
     */
    public function getReverseColumnMap(\Phalcon\Mvc\ModelInterface $model);

    /**
     * Check if a model has certain attribute
     *
     * @param mixed $model 
     * @param string $attribute 
     * @return bool 
     */
    public function hasAttribute(\Phalcon\Mvc\ModelInterface $model, $attribute);

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
     * @return array 
     */
    public function read($key);

    /**
     * Writes meta-data to the adapter
     *
     * @param string $key 
     * @param array $data 
     */
    public function write($key, $data);

}
