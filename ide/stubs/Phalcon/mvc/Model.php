<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\Model
 * Phalcon\Mvc\Model connects business objects and database tables to create
 * a persistable domain model where logic and data are presented in one wrapping.
 * It‘s an implementation of the object-relational mapping (ORM).
 * A model represents the information (data) of the application and the rules to manipulate that data.
 * Models are primarily used for managing the rules of interaction with a corresponding database table.
 * In most cases, each table in your database will correspond to one model in your application.
 * The bulk of your application's business logic will be concentrated in the models.
 * Phalcon\Mvc\Model is the first ORM written in Zephir/C languages for PHP, giving to developers high performance
 * when interacting with databases while is also easy to use.
 * <code>
 * $robot = new Robots();
 * $robot->type = 'mechanical';
 * $robot->name = 'Astro Boy';
 * $robot->year = 1952;
 * if ($robot->save() == false) {
 * echo "Umh, We can store robots: ";
 * foreach ($robot->getMessages() as $message) {
 * echo message;
 * }
 * } else {
 * echo "Great, a new robot was saved successfully!";
 * }
 * </code>
 */
abstract class Model implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\ModelInterface, \Phalcon\Mvc\Model\ResultInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable, \JsonSerializable
{

    const OP_NONE = 0;


    const OP_CREATE = 1;


    const OP_UPDATE = 2;


    const OP_DELETE = 3;


    const DIRTY_STATE_PERSISTENT = 0;


    const DIRTY_STATE_TRANSIENT = 1;


    const DIRTY_STATE_DETACHED = 2;


    protected $_dependencyInjector;


    protected $_modelsManager;


    protected $_modelsMetaData;


    protected $_errorMessages;


    protected $_operationMade = 0;


    protected $_dirtyState = 1;


    protected $_transaction;


    protected $_uniqueKey;


    protected $_uniqueParams;


    protected $_uniqueTypes;


    protected $_skipped;


    protected $_related;


    protected $_snapshot;


    /**
     * Phalcon\Mvc\Model constructor
     *
     * @param mixed $data 
     * @param mixed $dependencyInjector 
     * @param mixed $modelsManager 
     */
    public final function __construct($data = null, \Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Mvc\Model\ManagerInterface $modelsManager = null) {}

    /**
     * Sets the dependency injection container
     *
     * @param mixed $dependencyInjector 
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the dependency injection container
     *
     * @return \Phalcon\DiInterface 
     */
    public function getDI() {}

    /**
     * Sets a custom events manager
     *
     * @param mixed $eventsManager 
     */
    protected function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the custom events manager
     *
     * @return \Phalcon\Events\ManagerInterface 
     */
    protected function getEventsManager() {}

    /**
     * Returns the models meta-data service related to the entity instance
     *
     * @return \Phalcon\Mvc\Model\MetaDataInterface 
     */
    public function getModelsMetaData() {}

    /**
     * Returns the models manager related to the entity instance
     *
     * @return \Phalcon\Mvc\Model\ManagerInterface 
     */
    public function getModelsManager() {}

    /**
     * Sets a transaction related to the Model instance
     * <code>
     * use Phalcon\Mvc\Model\Transaction\Manager as TxManager;
     * use Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
     * try {
     * $txManager = new TxManager();
     * $transaction = $txManager->get();
     * $robot = new Robots();
     * $robot->setTransaction($transaction);
     * $robot->name = 'WALL·E';
     * $robot->created_at = date('Y-m-d');
     * if ($robot->save() == false) {
     * $transaction->rollback("Can't save robot");
     * }
     * $robotPart = new RobotParts();
     * $robotPart->setTransaction($transaction);
     * $robotPart->type = 'head';
     * if ($robotPart->save() == false) {
     * $transaction->rollback("Robot part cannot be saved");
     * }
     * $transaction->commit();
     * } catch (TxFailed $e) {
     * echo 'Failed, reason: ', $e->getMessage();
     * }
     * </code>
     *
     * @param mixed $transaction 
     * @return Model 
     */
    public function setTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction) {}

    /**
     * Sets table name which model should be mapped
     *
     * @param string $source 
     * @return Model 
     */
    protected function setSource($source) {}

    /**
     * Returns table name mapped in the model
     *
     * @return string 
     */
    public function getSource() {}

    /**
     * Sets schema name where table mapped is located
     *
     * @param string $schema 
     * @return Model 
     */
    protected function setSchema($schema) {}

    /**
     * Returns schema name where table mapped is located
     *
     * @return string 
     */
    public function getSchema() {}

    /**
     * Sets the DependencyInjection connection service name
     *
     * @param string $connectionService 
     * @return Model 
     */
    public function setConnectionService($connectionService) {}

    /**
     * Sets the DependencyInjection connection service name used to read data
     *
     * @param string $connectionService 
     * @return Model 
     */
    public function setReadConnectionService($connectionService) {}

    /**
     * Sets the DependencyInjection connection service name used to write data
     *
     * @param string $connectionService 
     * @return Model 
     */
    public function setWriteConnectionService($connectionService) {}

    /**
     * Returns the DependencyInjection connection service name used to read data related the model
     *
     * @return string 
     */
    public function getReadConnectionService() {}

    /**
     * Returns the DependencyInjection connection service name used to write data related to the model
     *
     * @return string 
     */
    public function getWriteConnectionService() {}

    /**
     * Sets the dirty state of the object using one of the DIRTY_STATE_* constants
     *
     * @param int $dirtyState 
     * @return ModelInterface 
     */
    public function setDirtyState($dirtyState) {}

    /**
     * Returns one of the DIRTY_STATE_* constants telling if the record exists in the database or not
     *
     * @return int 
     */
    public function getDirtyState() {}

    /**
     * Gets the connection used to read data for the model
     *
     * @return \Phalcon\Db\AdapterInterface 
     */
    public function getReadConnection() {}

    /**
     * Gets the connection used to write data to the model
     *
     * @return \Phalcon\Db\AdapterInterface 
     */
    public function getWriteConnection() {}

    /**
     * Assigns values to a model from an array
     * <code>
     * $robot->assign(array(
     * 'type' => 'mechanical',
     * 'name' => 'Astro Boy',
     * 'year' => 1952
     * ));
     * //assign by db row, column map needed
     * $robot->assign($dbRow, array(
     * 'db_type' => 'type',
     * 'db_name' => 'name',
     * 'db_year' => 'year'
     * ));
     * //allow assign only name and year
     * $robot->assign($_POST, null, array('name', 'year');
     * </code>
     *
     * @param array $data 
     * @param array $dataColumnMap array to transform keys of data to another
     * @param array $whiteList 
     * @return \Phalcon\Mvc\Model 
     */
    public function assign(array $data, $dataColumnMap = null, $whiteList = null) {}

    /**
     * Assigns values to a model from an array returning a new model.
     * <code>
     * $robot = \Phalcon\Mvc\Model::cloneResultMap(new Robots(), array(
     * 'type' => 'mechanical',
     * 'name' => 'Astro Boy',
     * 'year' => 1952
     * ));
     * </code>
     *
     * @param \Phalcon\Mvc\ModelInterface|\Phalcon\Mvc\Model\Row $base 
     * @param array $data 
     * @param array $columnMap 
     * @param int $dirtyState 
     * @param boolean $keepSnapshots 
     * @return Model 
     */
    public static function cloneResultMap($base, array $data, $columnMap, $dirtyState = 0, $keepSnapshots = null) {}

    /**
     * Returns an hydrated result based on the data and the column map
     *
     * @param array $data 
     * @param array $columnMap 
     * @param int $hydrationMode 
     * @return mixed 
     */
    public static function cloneResultMapHydrate(array $data, $columnMap, $hydrationMode) {}

    /**
     * Assigns values to a model from an array returning a new model
     * <code>
     * $robot = Phalcon\Mvc\Model::cloneResult(new Robots(), array(
     * 'type' => 'mechanical',
     * 'name' => 'Astro Boy',
     * 'year' => 1952
     * ));
     * </code>
     *
     * @param mixed $base 
     * @param array $data 
     * @param int $dirtyState 
     * @param \Phalcon\Mvc\ModelInterface $$base 
     * @return \Phalcon\Mvc\ModelInterface 
     */
    public static function cloneResult(ModelInterface $base, array $data, $dirtyState = 0) {}

    /**
     * Allows to query a set of records that match the specified conditions
     * <code>
     * // How many robots are there?
     * $robots = Robots::find();
     * echo 'There are ', count($robots), "\n";
     * // How many mechanical robots are there?
     * $robots = Robots::find("type='mechanical'");
     * echo 'There are ', count($robots), "\n";
     * // Get and print virtual robots ordered by name
     * $robots = Robots::find(["type='virtual'", 'order' => 'name']);
     * foreach ($robots as $robot) {
     * echo $robot->name, "\n";
     * }
     * // Get first 100 virtual robots ordered by name
     * $robots = Robots::find(["type='virtual'", 'order' => 'name', 'limit' => 100]);
     * foreach ($robots as $robot) {
     * echo $robot->name, "\n";
     * }
     * </code>
     *
     * @param mixed $parameters 
     * @return ResultsetInterface 
     */
    public static function find($parameters = null) {}

    /**
     * Allows to query the first record that match the specified conditions
     * <code>
     * //What's the first robot in robots table?
     * $robot = Robots::findFirst();
     * echo "The robot name is ", $robot->name;
     * //What's the first mechanical robot in robots table?
     * $robot = Robots::findFirst("type='mechanical'");
     * echo "The first mechanical robot name is ", $robot->name;
     * //Get first virtual robot ordered by name
     * $robot = Robots::findFirst(array("type='virtual'", "order" => "name"));
     * echo "The first virtual robot name is ", $robot->name;
     * </code>
     *
     * @param string|array $parameters 
     * @return static 
     */
    public static function findFirst($parameters = null) {}

    /**
     * Create a criteria for a specific model
     *
     * @param mixed $dependencyInjector 
     * @return \Phalcon\Mvc\Model\Criteria 
     */
    public static function query(\Phalcon\DiInterface $dependencyInjector = null) {}

    /**
     * Checks if the current record already exists or not
     *
     * @param \Phalcon\Mvc\Model\MetaDataInterface $metaData 
     * @param \Phalcon\Db\AdapterInterface $connection 
     * @param string|array $table 
     * @return boolean 
     */
    protected function _exists(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table = null) {}

    /**
     * Generate a PHQL SELECT statement for an aggregate
     *
     * @param string $functionName 
     * @param string $alias 
     * @param array $parameters 
     * @param string $function 
     * @return \Phalcon\Mvc\Model\ResultsetInterface 
     */
    protected static function _groupResult($functionName, $alias, $parameters) {}

    /**
     * Allows to count how many records match the specified conditions
     * <code>
     * //How many robots are there?
     * $number = Robots::count();
     * echo "There are ", $number, "\n";
     * //How many mechanical robots are there?
     * $number = Robots::count("type = 'mechanical'");
     * echo "There are ", $number, " mechanical robots\n";
     * </code>
     *
     * @param array $parameters 
     * @return mixed 
     */
    public static function count($parameters = null) {}

    /**
     * Allows to calculate a sum on a column that match the specified conditions
     * <code>
     * //How much are all robots?
     * $sum = Robots::sum(array('column' => 'price'));
     * echo "The total price of robots is ", $sum, "\n";
     * //How much are mechanical robots?
     * $sum = Robots::sum(array("type = 'mechanical'", 'column' => 'price'));
     * echo "The total price of mechanical robots is  ", $sum, "\n";
     * </code>
     *
     * @param array $parameters 
     * @return mixed 
     */
    public static function sum($parameters = null) {}

    /**
     * Allows to get the maximum value of a column that match the specified conditions
     * <code>
     * //What is the maximum robot id?
     * $id = Robots::maximum(array('column' => 'id'));
     * echo "The maximum robot id is: ", $id, "\n";
     * //What is the maximum id of mechanical robots?
     * $sum = Robots::maximum(array("type='mechanical'", 'column' => 'id'));
     * echo "The maximum robot id of mechanical robots is ", $id, "\n";
     * </code>
     *
     * @param array $parameters 
     * @return mixed 
     */
    public static function maximum($parameters = null) {}

    /**
     * Allows to get the minimum value of a column that match the specified conditions
     * <code>
     * //What is the minimum robot id?
     * $id = Robots::minimum(array('column' => 'id'));
     * echo "The minimum robot id is: ", $id;
     * //What is the minimum id of mechanical robots?
     * $sum = Robots::minimum(array("type='mechanical'", 'column' => 'id'));
     * echo "The minimum robot id of mechanical robots is ", $id;
     * </code>
     *
     * @param array $parameters 
     * @return mixed 
     */
    public static function minimum($parameters = null) {}

    /**
     * Allows to calculate the average value on a column matching the specified conditions
     * <code>
     * //What's the average price of robots?
     * $average = Robots::average(array('column' => 'price'));
     * echo "The average price is ", $average, "\n";
     * //What's the average price of mechanical robots?
     * $average = Robots::average(array("type='mechanical'", 'column' => 'price'));
     * echo "The average price of mechanical robots is ", $average, "\n";
     * </code>
     *
     * @param array $parameters 
     * @return double 
     */
    public static function average($parameters = null) {}

    /**
     * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
     *
     * @param string $eventName 
     * @return bool 
     */
    public function fireEvent($eventName) {}

    /**
     * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
     * This method stops if one of the callbacks/listeners returns boolean false
     *
     * @param string $eventName 
     * @return bool 
     */
    public function fireEventCancel($eventName) {}

    /**
     * Cancel the current operation
     */
    protected function _cancelOperation() {}

    /**
     * Appends a customized message on the validation process
     * <code>
     * use Phalcon\Mvc\Model;
     * use Phalcon\Mvc\Model\Message as Message;
     * class Robots extends Model
     * {
     * public function beforeSave()
     * {
     * if ($this->name == 'Peter') {
     * $message = new Message("Sorry, but a robot cannot be named Peter");
     * $this->appendMessage($message);
     * }
     * }
     * }
     * </code>
     *
     * @param mixed $message 
     * @return Model 
     */
    public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message) {}

    /**
     * Executes validators on every validation call
     * <code>
     * use Phalcon\Mvc\Model;
     * use Phalcon\Validation;
     * use Phalcon\Validation\Validator\ExclusionIn;
     * class Subscriptors extends Model
     * {
     * public function validation()
     * {
     * $validator = new Validation();
     * $validator->add('status', new ExclusionIn(array(
     * 'domain' => array('A', 'I')
     * )));
     * return $this->validate($validator);
     * }
     * }
     * </code>
     *
     * @param mixed $validator 
     * @return bool 
     */
    protected function validate(\Phalcon\ValidationInterface $validator) {}

    /**
     * Check whether validation process has generated any messages
     * <code>
     * use Phalcon\Mvc\Model;
     * use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
     * class Subscriptors extends Model
     * {
     * public function validation()
     * {
     * $validator = new Validation();
     * $validator->validate('status', new ExclusionIn(array(
     * 'domain' => array('A', 'I')
     * ));
     * return $this->validate($validator);
     * }
     * }
     * </code>
     *
     * @return bool 
     */
    public function validationHasFailed() {}

    /**
     * Returns array of validation messages
     * <code>
     * $robot = new Robots();
     * $robot->type = 'mechanical';
     * $robot->name = 'Astro Boy';
     * $robot->year = 1952;
     * if ($robot->save() == false) {
     * echo "Umh, We can't store robots right now ";
     * foreach ($robot->getMessages() as $message) {
     * echo $message;
     * }
     * } else {
     * echo "Great, a new robot was saved successfully!";
     * }
     * </code>
     *
     * @param mixed $filter 
     * @return MessageInterface[] 
     */
    public function getMessages($filter = null) {}

    /**
     * Reads "belongs to" relations and check the virtual foreign keys when inserting or updating records
     * to verify that inserted/updated values are present in the related entity
     *
     * @return bool 
     */
    protected final function _checkForeignKeysRestrict() {}

    /**
     * Reads both "hasMany" and "hasOne" relations and checks the virtual foreign keys (cascade) when deleting records
     *
     * @return bool 
     */
    protected final function _checkForeignKeysReverseCascade() {}

    /**
     * Reads both "hasMany" and "hasOne" relations and checks the virtual foreign keys (restrict) when deleting records
     *
     * @return bool 
     */
    protected final function _checkForeignKeysReverseRestrict() {}

    /**
     * Executes internal hooks before save a record
     *
     * @param mixed $metaData 
     * @param bool $exists 
     * @param mixed $identityField 
     * @return bool 
     */
    protected function _preSave(\Phalcon\Mvc\Model\MetaDataInterface $metaData, $exists, $identityField) {}

    /**
     * Executes internal events after save a record
     *
     * @param bool $success 
     * @param bool $exists 
     * @return bool 
     */
    protected function _postSave($success, $exists) {}

    /**
     * Sends a pre-build INSERT SQL statement to the relational database system
     *
     * @param \Phalcon\Mvc\Model\MetaDataInterface $metaData 
     * @param \Phalcon\Db\AdapterInterface $connection 
     * @param string|array $table 
     * @param boolean|string $identityField 
     * @return boolean 
     */
    protected function _doLowInsert(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table, $identityField) {}

    /**
     * Sends a pre-build UPDATE SQL statement to the relational database system
     *
     * @param \Phalcon\Mvc\Model\MetaDataInterface $metaData 
     * @param \Phalcon\Db\AdapterInterface $connection 
     * @param string|array $table 
     * @return boolean 
     */
    protected function _doLowUpdate(\Phalcon\Mvc\Model\MetaDataInterface $metaData, \Phalcon\Db\AdapterInterface $connection, $table) {}

    /**
     * Saves related records that must be stored prior to save the master record
     *
     * @param \Phalcon\Db\AdapterInterface $connection 
     * @param \Phalcon\Mvc\ModelInterface[] $related 
     * @return boolean 
     */
    protected function _preSaveRelatedRecords(\Phalcon\Db\AdapterInterface $connection, $related) {}

    /**
     * Save the related records assigned in the has-one/has-many relations
     *
     * @param \Phalcon\Db\AdapterInterface $connection 
     * @param \Phalcon\Mvc\ModelInterface[] $related 
     * @return boolean 
     */
    protected function _postSaveRelatedRecords(\Phalcon\Db\AdapterInterface $connection, $related) {}

    /**
     * Inserts or updates a model instance. Returning true on success or false otherwise.
     * <code>
     * //Creating a new robot
     * $robot = new Robots();
     * $robot->type = 'mechanical';
     * $robot->name = 'Astro Boy';
     * $robot->year = 1952;
     * $robot->save();
     * //Updating a robot name
     * $robot = Robots::findFirst("id=100");
     * $robot->name = "Biomass";
     * $robot->save();
     * </code>
     *
     * @param array $data 
     * @param array $whiteList 
     * @return boolean 
     */
    public function save($data = null, $whiteList = null) {}

    /**
     * Inserts a model instance. If the instance already exists in the persistence it will throw an exception
     * Returning true on success or false otherwise.
     * <code>
     * //Creating a new robot
     * $robot = new Robots();
     * $robot->type = 'mechanical';
     * $robot->name = 'Astro Boy';
     * $robot->year = 1952;
     * $robot->create();
     * //Passing an array to create
     * $robot = new Robots();
     * $robot->create(array(
     * 'type' => 'mechanical',
     * 'name' => 'Astro Boy',
     * 'year' => 1952
     * ));
     * </code>
     *
     * @param mixed $data 
     * @param mixed $whiteList 
     * @return bool 
     */
    public function create($data = null, $whiteList = null) {}

    /**
     * Updates a model instance. If the instance doesn't exist in the persistence it will throw an exception
     * Returning true on success or false otherwise.
     * <code>
     * //Updating a robot name
     * $robot = Robots::findFirst("id=100");
     * $robot->name = "Biomass";
     * $robot->update();
     * </code>
     *
     * @param mixed $data 
     * @param mixed $whiteList 
     * @return bool 
     */
    public function update($data = null, $whiteList = null) {}

    /**
     * Deletes a model instance. Returning true on success or false otherwise.
     * <code>
     * $robot = Robots::findFirst("id=100");
     * $robot->delete();
     * foreach (Robots::find("type = 'mechanical'") as $robot) {
     * $robot->delete();
     * }
     * </code>
     *
     * @return bool 
     */
    public function delete() {}

    /**
     * Returns the type of the latest operation performed by the ORM
     * Returns one of the OP_* class constants
     *
     * @return int 
     */
    public function getOperationMade() {}

    /**
     * Refreshes the model attributes re-querying the record from the database
     *
     * @return Model 
     */
    public function refresh() {}

    /**
     * Skips the current operation forcing a success state
     *
     * @param bool $skip 
     */
    public function skipOperation($skip) {}

    /**
     * Reads an attribute value by its name
     * <code>
     * echo $robot->readAttribute('name');
     * </code>
     *
     * @param string $attribute 
     */
    public function readAttribute($attribute) {}

    /**
     * Writes an attribute value by its name
     * <code>
     * $robot->writeAttribute('name', 'Rosey');
     * </code>
     *
     * @param string $attribute 
     * @param mixed $value 
     */
    public function writeAttribute($attribute, $value) {}

    /**
     * Sets a list of attributes that must be skipped from the
     * generated INSERT/UPDATE statement
     * <code>
     * <?php
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function initialize()
     * {
     * $this->skipAttributes(array('price'));
     * }
     * }
     * </code>
     *
     * @param array $attributes 
     */
    protected function skipAttributes(array $attributes) {}

    /**
     * Sets a list of attributes that must be skipped from the
     * generated INSERT statement
     * <code>
     * <?php
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function initialize()
     * {
     * $this->skipAttributesOnCreate(array('created_at'));
     * }
     * }
     * </code>
     *
     * @param array $attributes 
     */
    protected function skipAttributesOnCreate(array $attributes) {}

    /**
     * Sets a list of attributes that must be skipped from the
     * generated UPDATE statement
     * <code>
     * <?php
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function initialize()
     * {
     * $this->skipAttributesOnUpdate(array('modified_in'));
     * }
     * }
     * </code>
     *
     * @param array $attributes 
     */
    protected function skipAttributesOnUpdate(array $attributes) {}

    /**
     * Sets a list of attributes that must be skipped from the
     * generated UPDATE statement
     * <code>
     * <?php
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function initialize()
     * {
     * $this->allowEmptyStringValues(array('name'));
     * }
     * }
     * </code>
     *
     * @param array $attributes 
     */
    protected function allowEmptyStringValues(array $attributes) {}

    /**
     * Setup a 1-1 relation between two models
     * <code>
     * <?php
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function initialize()
     * {
     * $this->hasOne('id', 'RobotsDescription', 'robots_id');
     * }
     * }
     * </code>
     *
     * @param mixed $fields 
     * @param string $referenceModel 
     * @param mixed $referencedFields 
     * @param mixed $options 
     * @return \Phalcon\Mvc\Model\Relation 
     */
    protected function hasOne($fields, $referenceModel, $referencedFields, $options = null) {}

    /**
     * Setup a relation reverse 1-1  between two models
     * <code>
     * <?php
     * class RobotsParts extends \Phalcon\Mvc\Model
     * {
     * public function initialize()
     * {
     * $this->belongsTo('robots_id', 'Robots', 'id');
     * }
     * }
     * </code>
     *
     * @param mixed $fields 
     * @param string $referenceModel 
     * @param mixed $referencedFields 
     * @param mixed $options 
     * @return \Phalcon\Mvc\Model\Relation 
     */
    protected function belongsTo($fields, $referenceModel, $referencedFields, $options = null) {}

    /**
     * Setup a relation 1-n between two models
     * <code>
     * <?php
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function initialize()
     * {
     * $this->hasMany('id', 'RobotsParts', 'robots_id');
     * }
     * }
     * </code>
     *
     * @param mixed $fields 
     * @param string $referenceModel 
     * @param mixed $referencedFields 
     * @param mixed $options 
     * @return \Phalcon\Mvc\Model\Relation 
     */
    protected function hasMany($fields, $referenceModel, $referencedFields, $options = null) {}

    /**
     * Setup a relation n-n between two models through an intermediate relation
     * <code>
     * <?php
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function initialize()
     * {
     * //Setup a many-to-many relation to Parts through RobotsParts
     * $this->hasManyToMany(
     * 'id',
     * 'RobotsParts',
     * 'robots_id',
     * 'parts_id',
     * 'Parts',
     * 'id'
     * );
     * }
     * }
     * </code>
     *
     * @param	string|array fields
     * @param	string intermediateModel
     * @param	string|array intermediateFields
     * @param	string|array intermediateReferencedFields
     * @param	string referencedModel
     * @param mixed $fields 
     * @param string $intermediateModel 
     * @param mixed $intermediateFields 
     * @param mixed $intermediateReferencedFields 
     * @param string $referenceModel 
     * @param string|array $referencedFields 
     * @param array $options 
     * @return \Phalcon\Mvc\Model\Relation 
     */
    protected function hasManyToMany($fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referenceModel, $referencedFields, $options = null) {}

    /**
     * Setups a behavior in a model
     * <code>
     * <?php
     * use Phalcon\Mvc\Model;
     * use Phalcon\Mvc\Model\Behavior\Timestampable;
     * class Robots extends Model
     * {
     * public function initialize()
     * {
     * $this->addBehavior(new Timestampable(array(
     * 'onCreate' => array(
     * 'field' => 'created_at',
     * 'format' => 'Y-m-d'
     * )
     * )));
     * }
     * }
     * </code>
     *
     * @param mixed $behavior 
     */
    public function addBehavior(\Phalcon\Mvc\Model\BehaviorInterface $behavior) {}

    /**
     * Sets if the model must keep the original record snapshot in memory
     * <code>
     * <?php
     * use Phalcon\Mvc\Model;
     * class Robots extends Model
     * {
     * public function initialize()
     * {
     * $this->keepSnapshots(true);
     * }
     * }
     * </code>
     *
     * @param bool $keepSnapshot 
     */
    protected function keepSnapshots($keepSnapshot) {}

    /**
     * Sets the record's snapshot data.
     * This method is used internally to set snapshot data when the model was set up to keep snapshot data
     *
     * @param array $data 
     * @param array $columnMap 
     */
    public function setSnapshotData(array $data, $columnMap = null) {}

    /**
     * Checks if the object has internal snapshot data
     *
     * @return bool 
     */
    public function hasSnapshotData() {}

    /**
     * Returns the internal snapshot data
     *
     * @return array 
     */
    public function getSnapshotData() {}

    /**
     * Check if a specific attribute has changed
     * This only works if the model is keeping data snapshots
     *
     * @param string|array $fieldName 
     * @return bool 
     */
    public function hasChanged($fieldName = null) {}

    /**
     * Returns a list of changed values
     *
     * @return array 
     */
    public function getChangedFields() {}

    /**
     * Sets if a model must use dynamic update instead of the all-field update
     * <code>
     * <?php
     * use Phalcon\Mvc\Model;
     * class Robots extends Model
     * {
     * public function initialize()
     * {
     * $this->useDynamicUpdate(true);
     * }
     * }
     * </code>
     *
     * @param bool $dynamicUpdate 
     */
    protected function useDynamicUpdate($dynamicUpdate) {}

    /**
     * Returns related records based on defined relations
     *
     * @param string $alias 
     * @param array $arguments 
     * @return \Phalcon\Mvc\Model\ResultsetInterface 
     */
    public function getRelated($alias, $arguments = null) {}

    /**
     * Returns related records defined relations depending on the method name
     *
     * @param string $modelName 
     * @param string $method 
     * @param array $arguments 
     * @return mixed 
     */
    protected function _getRelatedRecords($modelName, $method, $arguments) {}

    /**
     * Try to check if the query must invoke a finder
     *
     * @param string $method 
     * @param array $arguments 
     * @return \Phalcon\Mvc\ModelInterface[]|\Phalcon\Mvc\ModelInterface|boolean 
     */
    protected final static function _invokeFinder($method, $arguments) {}

    /**
     * Handles method calls when a method is not implemented
     *
     * @param	string method
     * @param	array arguments
     * @return	mixed
     * @param string $method 
     * @param mixed $arguments 
     */
    public function __call($method, $arguments) {}

    /**
     * Handles method calls when a static method is not implemented
     *
     * @param	string method
     * @param	array arguments
     * @return	mixed
     * @param string $method 
     * @param mixed $arguments 
     */
    public static function __callStatic($method, $arguments) {}

    /**
     * Magic method to assign values to the the model
     *
     * @param string $property 
     * @param mixed $value 
     */
    public function __set($property, $value) {}

    /**
     * Check for, and attempt to use, possible setter.
     *
     * @param string $property 
     * @param mixed $value 
     * @return string 
     */
    protected final function _possibleSetter($property, $value) {}

    /**
     * Magic method to get related records using the relation alias as a property
     *
     * @param string $property 
     * @return \Phalcon\Mvc\Model\Resultset|Phalcon\Mvc\Model 
     */
    public function __get($property) {}

    /**
     * Magic method to check if a property is a valid relation
     *
     * @param string $property 
     * @return bool 
     */
    public function __isset($property) {}

    /**
     * Serializes the object ignoring connections, services, related objects or static properties
     *
     * @return string 
     */
    public function serialize() {}

    /**
     * Unserializes the object from a serialized string
     *
     * @param string $data 
     */
    public function unserialize($data) {}

    /**
     * Returns a simple representation of the object that can be used with var_dump
     * <code>
     * var_dump($robot->dump());
     * </code>
     *
     * @return array 
     */
    public function dump() {}

    /**
     * Returns the instance as an array representation
     * <code>
     * print_r($robot->toArray());
     * </code>
     *
     * @param mixed $columns 
     * @param array $$columns 
     * @return array 
     */
    public function toArray($columns = null) {}

    /**
     * Serializes the object for json_encode
     * <code>
     * echo json_encode($robot);
     * </code>
     *
     * @return array 
     */
    public function jsonSerialize() {}

    /**
     * Enables/disables options in the ORM
     *
     * @param array $options 
     */
    public static function setup(array $options) {}

    /**
     * Reset a model instance data
     */
    public function reset() {}

}
