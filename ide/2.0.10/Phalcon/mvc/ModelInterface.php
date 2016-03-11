<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\ModelInterface
 * Interface for Phalcon\Mvc\Model
 */
interface ModelInterface
{

    /**
     * Sets a transaction related to the Model instance
     *
     * @param mixed $transaction 
     * @return \Phalcon\Mvc\ModelInterface 
     */
    public function setTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction);

    /**
     * Returns table name mapped in the model
     *
     * @return string 
     */
    public function getSource();

    /**
     * Returns schema name where table mapped is located
     *
     * @return string 
     */
    public function getSchema();

    /**
     * Sets both read/write connection services
     *
     * @param string $connectionService 
     */
    public function setConnectionService($connectionService);

    /**
     * Sets the DependencyInjection connection service used to write data
     *
     * @param string $connectionService 
     */
    public function setWriteConnectionService($connectionService);

    /**
     * Sets the DependencyInjection connection service used to read data
     *
     * @param string $connectionService 
     */
    public function setReadConnectionService($connectionService);

    /**
     * Returns DependencyInjection connection service used to read data
     *
     * @return string 
     */
    public function getReadConnectionService();

    /**
     * Returns DependencyInjection connection service used to write data
     *
     * @return string 
     */
    public function getWriteConnectionService();

    /**
     * Gets internal database connection
     *
     * @return \Phalcon\Db\AdapterInterface 
     */
    public function getReadConnection();

    /**
     * Gets internal database connection
     *
     * @return \Phalcon\Db\AdapterInterface 
     */
    public function getWriteConnection();

    /**
     * Sets the dirty state of the object using one of the DIRTY_STATE_* constants
     *
     * @param int $dirtyState 
     * @return \Phalcon\Mvc\ModelInterface 
     */
    public function setDirtyState($dirtyState);

    /**
     * Returns one of the DIRTY_STATE_* constants telling if the record exists in the database or not
     *
     * @return int 
     */
    public function getDirtyState();

    /**
     * Assigns values to a model from an array
     *
     * @param array $data 
     * @param mixed $dataColumnMap 
     * @param mixed $whiteList 
     * @param \Phalcon\Mvc\Model $object 
     * @param array $columnMap 
     * @return \Phalcon\Mvc\Model 
     */
    public function assign($data, $dataColumnMap = null, $whiteList = null);

    /**
     * Assigns values to a model from an array returning a new model
     *
     * @param \Phalcon\Mvc\Model $base 
     * @param array $data 
     * @param array $columnMap 
     * @param int $dirtyState 
     * @param boolean $keepSnapshots 
     * @return \Phalcon\Mvc\Model 
     */
    public static function cloneResultMap($base, $data, $columnMap, $dirtyState = 0, $keepSnapshots = null);

    /**
     * Assigns values to a model from an array returning a new model
     *
     * @param \Phalcon\Mvc\ModelInterface $base 
     * @param array $data 
     * @param int $dirtyState 
     * @return \Phalcon\Mvc\ModelInterface 
     */
    public static function cloneResult(\Phalcon\Mvc\ModelInterface $base, $data, $dirtyState = 0);

    /**
     * Returns an hydrated result based on the data and the column map
     *
     * @param array $data 
     * @param array $columnMap 
     * @param int $hydrationMode 
     */
    public static function cloneResultMapHydrate($data, $columnMap, $hydrationMode);

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param  array $parameters
     * @return \Phalcon\Mvc\Model\ResultsetInterface 
     */
    public static function find($parameters = null);

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param array $parameters 
     * @return static 
     */
    public static function findFirst($parameters = null);

    /**
     * Create a criteria for a especific model
     *
     * @param \Phalcon\DiInterface $dependencyInjector 
     * @return \Phalcon\Mvc\Model\CriteriaInterface 
     */
    public static function query(\Phalcon\DiInterface $dependencyInjector = null);

    /**
     * Allows to count how many records match the specified conditions
     *
     * @param array $parameters 
     * @return int 
     */
    public static function count($parameters = null);

    /**
     * Allows to calculate a summatory on a column that match the specified conditions
     *
     * @param array $parameters 
     * @return double 
     */
    public static function sum($parameters = null);

    /**
     * Allows to get the maximum value of a column that match the specified conditions
     *
     * @param array $parameters 
     * @return mixed 
     */
    public static function maximum($parameters = null);

    /**
     * Allows to get the minimum value of a column that match the specified conditions
     *
     * @param array $parameters 
     * @return mixed 
     */
    public static function minimum($parameters = null);

    /**
     * Allows to calculate the average value on a column matching the specified conditions
     *
     * @param array $parameters 
     * @return double 
     */
    public static function average($parameters = null);

    /**
     * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
     *
     * @param string $eventName 
     * @return boolean 
     */
    public function fireEvent($eventName);

    /**
     * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
     * This method stops if one of the callbacks/listeners returns boolean false
     *
     * @param string $eventName 
     * @return boolean 
     */
    public function fireEventCancel($eventName);

    /**
     * Appends a customized message on the validation process
     *
     * @param mixed $message 
     */
    public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message);

    /**
     * Check whether validation process has generated any messages
     *
     * @return boolean 
     */
    public function validationHasFailed();

    /**
     * Returns array of validation messages
     *
     * @return \Phalcon\Mvc\Model\MessageInterface[] 
     */
    public function getMessages();

    /**
     * Inserts or updates a model instance. Returning true on success or false otherwise.
     *
     * @param array $data 
     * @param array $whiteList 
     * @return boolean 
     */
    public function save($data = null, $whiteList = null);

    /**
     * Inserts a model instance. If the instance already exists in the persistance it will throw an exception
     * Returning true on success or false otherwise.
     *
     * @param array $data 
     * @param array $whiteList 
     * @return boolean 
     */
    public function create($data = null, $whiteList = null);

    /**
     * Updates a model instance. If the instance doesn't exist in the persistance it will throw an exception
     * Returning true on success or false otherwise.
     *
     * @param array $data 
     * @param array $whiteList 
     * @return boolean 
     */
    public function update($data = null, $whiteList = null);

    /**
     * Deletes a model instance. Returning true on success or false otherwise.
     *
     * @return boolean 
     */
    public function delete();

    /**
     * Returns the type of the latest operation performed by the ORM
     * Returns one of the OP_* class constants
     *
     * @return int 
     */
    public function getOperationMade();

    /**
     * Refreshes the model attributes re-querying the record from the database
     */
    public function refresh();

    /**
     * Skips the current operation forcing a success state
     *
     * @param bool $skip 
     */
    public function skipOperation($skip);

    /**
     * Returns related records based on defined relations
     *
     * @param string $alias 
     * @param array $arguments 
     * @return \Phalcon\Mvc\Model\ResultsetInterface 
     */
    public function getRelated($alias, $arguments = null);

    /**
     * Sets the record's snapshot data.
     * This method is used internally to set snapshot data when the model was set up to keep snapshot data
     *
     * @param array $data 
     * @param array $columnMap 
     */
    public function setSnapshotData($data, $columnMap = null);

    /**
     * Reset a model instance data
     */
    public function reset();
}
