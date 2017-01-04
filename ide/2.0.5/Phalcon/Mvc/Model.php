<?php

namespace Phalcon\Mvc;

use Phalcon\Di;
use Phalcon\Db\Column;
use Phalcon\Db\RawValue;
use Phalcon\DiInterface;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\ResultInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Model\ManagerInterface;
use Phalcon\Mvc\Model\MetaDataInterface;
use Phalcon\Db\AdapterInterface;
use Phalcon\Db\DialectInterface;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Mvc\Model\CriteriaInterface;
use Phalcon\Mvc\Model\TransactionInterface;
use Phalcon\Mvc\Model\Resultset;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Relation;
use Phalcon\Mvc\Model\RelationInterface;
use Phalcon\Mvc\Model\BehaviorInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\Model\MessageInterface;
use Phalcon\Events\ManagerInterface as EventsManagerInterface;


abstract class Model implements EntityInterface, ModelInterface, ResultInterface, InjectionAwareInterface, \Serializable
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

	protected $_operationMade;

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
	 * @param DiInterface $dependencyInjector
	 * @param ManagerInterface $modelsManager
	 */
	public final function __construct(DiInterface $dependencyInjector=null, ManagerInterface $modelsManager=null) {}

	/**
		 * We use a default DI if the user doesn't define one
	 * 
	 * @param DiInterface $dependencyInjector
		 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the dependency injection container
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Sets a custom events manager
	 * 
	 * @param EventsManagerInterface $eventsManager
	 *
	 * @return void
	 */
	protected function setEventsManager(EventsManagerInterface $eventsManager) {}

	/**
	 * Returns the custom events manager
	 *
	 * @return EventsManagerInterface
	 */
	protected function getEventsManager() {}

	/**
	 * Returns the models meta-data service related to the entity instance
	 *
	 * @return MetaDataInterface
	 */
	public function getModelsMetaData() {}

	/**
			 * Check if the DI is valid
			 *
	 * @return ManagerInterface
	 */
	public function getModelsManager() {}

	/**
	 * Sets a transaction related to the Model instance
	 *
	 *<code>
	 *use Phalcon\Mvc\Model\Transaction\Manager as TxManager;
	 *use Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
	 *
	 *try {
	 *
	 *  $txManager = new TxManager();
	 *
	 *  $transaction = $txManager->get();
	 *
	 *  $robot = new Robots();
	 *  $robot->setTransaction($transaction);
	 *  $robot->name = 'WALL·E';
	 *  $robot->created_at = date('Y-m-d');
	 *  if ($robot->save() == false) {
	 *	$transaction->rollback("Can't save robot");
	 *  }
	 *
	 *  $robotPart = new RobotParts();
	 *  $robotPart->setTransaction($transaction);
	 *  $robotPart->type = 'head';
	 *  if ($robotPart->save() == false) {
	 *	$transaction->rollback("Robot part cannot be saved");
	 *  }
	 *
	 *  $transaction->commit();
	 *
	 *} catch (TxFailed $e) {
	 *  echo 'Failed, reason: ', $e->getMessage();
	 *}
	 *
	 *</code>
	 * 
	 * @param TransactionInterface $transaction
	 *
	 * @return Model
	 */
	public function setTransaction(TransactionInterface $transaction) {}

	/**
	 * Sets table name which model should be mapped
	 * 
	 * @param string $source
	 *
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
	 *
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
	 *
	 * @return Model
	 */
	public function setConnectionService($connectionService) {}

	/**
	 * Sets the DependencyInjection connection service name used to read data
	 * 
	 * @param string $connectionService
	 *
	 * @return Model
	 */
	public function setReadConnectionService($connectionService) {}

	/**
	 * Sets the DependencyInjection connection service name used to write data
	 * 
	 * @param string $connectionService
	 *
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
	 *
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
	 * @return AdapterInterface
	 */
	public function getReadConnection() {}

	/**
	 * Gets the connection used to write data to the model
	 *
	 * @return AdapterInterface
	 */
	public function getWriteConnection() {}

	/**
	 * Assigns values to a model from an array
	 *
	 * <code>
	 * $robot->assign(array(
	 *	'type' => 'mechanical',
	 *	'name' => 'Astro Boy',
	 *	'year' => 1952
	 * ));
	 *
	 * //assign by db row, column map needed
	 * $robot->assign($dbRow, array(
	 *	'db_type' => 'type',
	 *	'db_name' => 'name',
	 *	'db_year' => 'year'
	 * ));
	 *
	 * //allow assign only name and year
	 * $robot->assign($_POST, null, array('name', 'year');
	 *</code>
	 *
	 * @param array $data
	 * @param mixed $dataColumnMap
	 * @param mixed $whiteList
	 * @param \array dataColumnMap array to transform keys of data to $another
	 * 
	 * @return Model
	 */
	public function assign(array $data, $dataColumnMap=null, $whiteList=null) {}

	/**
	 * Assigns values to a model from an array returning a new model.
	 *
	 *<code>
	 *$robot = \Phalcon\Mvc\Model::cloneResultMap(new Robots(), array(
	 *  'type' => 'mechanical',
	 *  'name' => 'Astro Boy',
	 *  'year' => 1952
	 *));
	 *</code>
	 *
	 * @param mixed $base
	 * @param array $data
	 * @param mixed $columnMap
	 * @param int $dirtyState
	 * @param boolean $keepSnapshots
	 * 
	 * @return Model
	 */
	public static function cloneResultMap($base, array $data, $columnMap, $dirtyState, $keepSnapshots=null) {}

	/**
		 * Models that keep snapshots store the original data in t
	 * 
	 * @param array $data
	 * @param mixed $columnMap
	 * @param int $hydrationMode
		 *
	 * @return mixed
	 */
	public static function cloneResultMapHydrate(array $data, $columnMap, $hydrationMode) {}

	/**
		 * If there is no column map and the hydration mode is arrays return the data as it is
	 * 
	 * @param ModelInterface $base
	 * @param array $data
	 * @param int $dirtyState
		 *
	 * @return mixed
	 */
	public static function cloneResult(ModelInterface $base, array $data, $dirtyState) {}

	/**
		 * Clone the base record
	 * 
	 * @param mixed $parameters
		 *
	 * @return \ResultsetInterface
	 */
	public static function find($parameters=null) {}

	/**
		 * Builds a query with the passed parameters
	 * 
	 * @param mixed $parameters
		 *
	 * @return Model
	 */
	public static function findFirst($parameters=null) {}

	/**
		 * Builds a query with the passed parameters
	 * 
	 * @param DiInterface $dependencyInjector
		 *
	 * @return Criteria
	 */
	public static function query(DiInterface $dependencyInjector=null) {}

	/**
		 * Use the global dependency injector if there is no one defined
	 * 
	 * @param \MetadataInterface $metaData
	 * @param AdapterInterface $connection
	 * @param mixed $table
		 *
	 * @return boolean
	 */
	protected function _exists(MetadataInterface $metaData, AdapterInterface $connection, $table=null) {}

	/**
		 * Builds a unique primary key condition
	 * 
	 * @param string $functionName
	 * @param string $alias
	 * @param mixed $parameters
		 *
	 * @return \ResultsetInterface
	 */
	protected static function _groupResult($functionName, $alias, $parameters) {}

	/**
		 * Builds the columns to query according to the received parameters
	 * 
	 * @param mixed $parameters
		 *
	 * @return mixed
	 */
	public static function count($parameters=null) {}

	/**
	 * Allows to calculate a summatory on a column that match the specified conditions
	 *
	 * <code>
	 *
	 * //How much are all robots?
	 * $sum = Robots::sum(array('column' => 'price'));
	 * echo "The total price of robots is ", $sum, "\n";
	 *
	 * //How much are mechanical robots?
	 * $sum = Robots::sum(array("type='mechanical'", 'column' => 'price'));
	 * echo "The total price of mechanical robots is  ", $sum, "\n";
	 *
	 * </code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return mixed
	 */
	public static function sum($parameters=null) {}

	/**
	 * Allows to get the maximum value of a column that match the specified conditions
	 *
	 * <code>
	 *
	 * //What is the maximum robot id?
	 * $id = Robots::maximum(array('column' => 'id'));
	 * echo "The maximum robot id is: ", $id, "\n";
	 *
	 * //What is the maximum id of mechanical robots?
	 * $sum = Robots::maximum(array("type='mechanical'", 'column' => 'id'));
	 * echo "The maximum robot id of mechanical robots is ", $id, "\n";
	 *
	 * </code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return mixed
	 */
	public static function maximum($parameters=null) {}

	/**
	 * Allows to get the minimum value of a column that match the specified conditions
	 *
	 * <code>
	 *
	 * //What is the minimum robot id?
	 * $id = Robots::minimum(array('column' => 'id'));
	 * echo "The minimum robot id is: ", $id;
	 *
	 * //What is the minimum id of mechanical robots?
	 * $sum = Robots::minimum(array("type='mechanical'", 'column' => 'id'));
	 * echo "The minimum robot id of mechanical robots is ", $id;
	 *
	 * </code>
	 *
	 * @param array $parameters
	 * 
	 * @return mixed
	 */
	public static function minimum($parameters=null) {}

	/**
	 * Allows to calculate the average value on a column matching the specified conditions
	 *
	 * <code>
	 *
	 * //What's the average price of robots?
	 * $average = Robots::average(array('column' => 'price'));
	 * echo "The average price is ", $average, "\n";
	 *
	 * //What's the average price of mechanical robots?
	 * $average = Robots::average(array("type='mechanical'", 'column' => 'price'));
	 * echo "The average price of mechanical robots is ", $average, "\n";
	 *
	 * </code>
	 *
	 * @param mixed $parameters
	 * 
	 * @return mixed
	 */
	public static function average($parameters=null) {}

	/**
	 * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
	 * 
	 * @param string $eventName
	 *
	 * @return boolean
	 */
	public function fireEvent($eventName) {}

	/**
		 * Check if there is a method with the same name of the event
	 * 
	 * @param string $eventName
		 *
	 * @return boolean
	 */
	public function fireEventCancel($eventName) {}

	/**
		 * Check if there is a method with the same name of the event
		 *
	 * @return void
	 */
	protected function _cancelOperation() {}

	/**
	 * Appends a customized message on the validation process
	 *
	 * <code>
	 * use \Phalcon\Mvc\Model\Message as Message;
	 *
	 * class Robots extends \Phalcon\Mvc\Model
	 * {
	 *
	 *   public function beforeSave()
	 *   {
	 *	 if ($this->name == 'Peter') {
	 *		$message = new Message("Sorry, but a robot cannot be named Peter");
	 *		$this->appendMessage($message);
	 *	 }
	 *   }
	 * }
	 * </code>
	 * 
	 * @param MessageInterface $message
	 *
	 * @return Model
	 */
	public function appendMessage(MessageInterface $message) {}

	/**
	 * Executes validators on every validation call
	 *
	 *<code>
	 *use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
	 *
	 *class Subscriptors extends \Phalcon\Mvc\Model
	 *{
	 *
	 *	public function validation()
	 *  {
	 * 		$this->validate(new ExclusionIn(array(
	 *			'field' => 'status',
	 *			'domain' => array('A', 'I')
	 *		)));
	 *		if ($this->validationHasFailed() == true) {
	 *			return false;
	 *		}
	 *	}
	 *}
	 *</code>
	 * 
	 * @param Model\ValidatorInterface $validator
	 *
	 * @return Model
	 */
	protected function validate(Model\ValidatorInterface $validator) {}

	/**
		 * Call the validation, if it returns false we append the messages to the current object
		 *
	 * @return boolean
	 */
	public function validationHasFailed() {}

	/**
	 * Returns all the validation messages
	 *
	 *<code>
	 *	$robot = new Robots();
	 *	$robot->type = 'mechanical';
	 *	$robot->name = 'Astro Boy';
	 *	$robot->year = 1952;
	 *	if ($robot->save() == false) {
	 *  	echo "Umh, We can't store robots right now ";
	 *  	foreach ($robot->getMessages() as $message) {
	 *			echo $message;
	 *		}
	 *	} else {
	 *  	echo "Great, a new robot was saved successfully!";
	 *	}
	 * </code>
	 * 
	 * @param mixed $filter
	 *
	 * @return MessageInterface[]
	 */
	public function getMessages($filter=null) {}

	/**
	 * Reads "belongs to" relations and check the virtual foreign keys when inserting or updating records
	 * to verify that inserted/updated values are present in the related entity
	 *
	 * @return boolean
	 */
	protected function _checkForeignKeysRestrict() {}

	/**
		 * Get the models manager
		 *
	 * @return boolean
	 */
	protected function _checkForeignKeysReverseCascade() {}

	/**
		 * Get the models manager
		 *
	 * @return boolean
	 */
	protected function _checkForeignKeysReverseRestrict() {}

	/**
		 * Get the models manager
	 * 
	 * @param \MetadataInterface $metaData
	 * @param boolean $exists
	 * @param mixed $identityField
		 *
	 * @return boolean
	 */
	protected function _preSave(MetadataInterface $metaData, $exists, $identityField) {}

	/**
		 * Run Validation Callbacks Before
	 * 
	 * @param boolean $success
	 * @param boolean $exists
		 *
	 * @return boolean
	 */
	protected function _postSave($success, $exists) {}

	/**
	 * Sends a pre-build INSERT SQL statement to the relational database system
	 *
	 * @param \MetadataInterface $metaData
	 * @param AdapterInterface $connection
	 * @param string|array $table
	 * @param boolean|string $identityField
	 * 
	 * @return boolean
	 */
	protected function _doLowInsert(MetadataInterface $metaData, AdapterInterface $connection, $table, $identityField) {}

	/**
		 * All fields in the model makes part or the INSERT
	 * 
	 * @param MetaDataInterface $metaData
	 * @param AdapterInterface $connection
	 * @param mixed $table
		 *
	 * @return boolean
	 */
	protected function _doLowUpdate(MetaDataInterface $metaData, AdapterInterface $connection, $table) {}

	/**
		 * Check if the model must use dynamic update
	 * 
	 * @param AdapterInterface $connection
	 * @param $related
		 *
	 * @return boolean
	 */
	protected function _preSaveRelatedRecords(AdapterInterface $connection, $related) {}

	/**
		 * Start an implicit transaction
	 * 
	 * @param AdapterInterface $connection
	 * @param $related
		 *
	 * @return boolean
	 */
	protected function _postSaveRelatedRecords(AdapterInterface $connection, $related) {}

	/**
			 * Try to get a relation with the same name
	 * 
	 * @param mixed $data
	 * @param mixed $whiteList
			 *
	 * @return boolean
	 */
	public function save($data=null, $whiteList=null) {}

	/**
		 * Create/Get the current database connection
	 * 
	 * @param mixed $data
	 * @param mixed $whiteList
		 *
	 * @return boolean
	 */
	public function create($data=null, $whiteList=null) {}

	/**
		 * Get the current connection
		 * If the record already exists we must throw an exception
	 * 
	 * @param mixed $data
	 * @param mixed $whiteList
		 *
	 * @return boolean
	 */
	public function update($data=null, $whiteList=null) {}

	/**
		 * We don't check if the record exists if the record is already checked
		 *
	 * @return boolean
	 */
	public function delete() {}

	/**
		 * Operation made is OP_DELETE
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
			 * We need to check if the record exists
	 * 
	 * @param boolean $skip
			 *
	 * @return void
	 */
	public function skipOperation($skip) {}

	/**
	 * Reads an attribute value by its name
	 *
	 * <code>
	 * echo $robot->readAttribute('name');
	 * </code>
	 * 
	 * @param string $attribute
	 *
	 * @return mixed
	 */
	public function readAttribute($attribute) {}

	/**
	 * Writes an attribute value by its name
	 *
	 *<code>
	 * 	$robot->writeAttribute('name', 'Rosey');
	 *</code>
	 * 
	 * @param string $attribute
	 * @param mixed $value
	 *
	 * @return void
	 */
	public function writeAttribute($attribute, $value) {}

	/**
	 * Sets a list of attributes that must be skipped from the
	 * generated INSERT/UPDATE statement
	 *
	 *<code>
	 *<?php
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *	   $this->skipAttributes(array('price'));
	 *   }
	 *}
	 *</code>
	 * 
	 * @param array $attributes
	 *
	 * @return void
	 */
	protected function skipAttributes(array $attributes) {}

	/**
	 * Sets a list of attributes that must be skipped from the
	 * generated INSERT statement
	 *
	 *<code>
	 *<?php
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *	   $this->skipAttributesOnCreate(array('created_at'));
	 *   }
	 *}
	 *</code>
	 * 
	 * @param array $attributes
	 *
	 * @return void
	 */
	protected function skipAttributesOnCreate(array $attributes) {}

	/**
	 * Sets a list of attributes that must be skipped from the
	 * generated UPDATE statement
	 *
	 *<code>
	 *<?php
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *	   $this->skipAttributesOnUpdate(array('modified_in'));
	 *   }
	 *}
	 *</code>
	 * 
	 * @param array $attributes
	 *
	 * @return void
	 */
	protected function skipAttributesOnUpdate(array $attributes) {}

	/**
	 * Sets a list of attributes that must be skipped from the
	 * generated UPDATE statement
	 *
	 *<code>
	 *<?php
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *	   $this->allowEmptyStringValues(array('name'));
	 *   }
	 *}
	 *</code>
	 * 
	 * @param array $attributes
	 *
	 * @return void
	 */
	protected function allowEmptyStringValues(array $attributes) {}

	/**
	 * Setup a 1-1 relation between two models
	 *
	 *<code>
	 *<?php
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *	   $this->hasOne('id', 'RobotsDescription', 'robots_id');
	 *   }
	 *}
	 *</code>
	 * 
	 * @param mixed $fields
	 * @param string $referenceModel
	 * @param mixed $referencedFields
	 * @param $options
	 *
	 * @return Relation
	 */
	protected function hasOne($fields, $referenceModel, $referencedFields, $options=null) {}

	/**
	 * Setup a relation reverse 1-1  between two models
	 *
	 *<code>
	 *<?php
	 *
	 *class RobotsParts extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *	   $this->belongsTo('robots_id', 'Robots', 'id');
	 *   }
	 *
	 *}
	 *</code>
	 * 
	 * @param mixed $fields
	 * @param string $referenceModel
	 * @param mixed $referencedFields
	 * @param $options
	 *
	 * @return Relation
	 */
	protected function belongsTo($fields, $referenceModel, $referencedFields, $options=null) {}

	/**
	 * Setup a relation 1-n between two models
	 *
	 *<code>
	 *<?php
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *	   $this->hasMany('id', 'RobotsParts', 'robots_id');
	 *   }
	 *}
	 *</code>
	 * 
	 * @param mixed $fields
	 * @param string $referenceModel
	 * @param mixed $referencedFields
	 * @param $options
	 *
	 * @return Relation
	 */
	protected function hasMany($fields, $referenceModel, $referencedFields, $options=null) {}

	/**
	 * Setup a relation n-n between two models through an intermediate relation
	 *
	 *<code>
	 *<?php
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *	   //Setup a many-to-many relation to Parts through RobotsParts
	 *	   $this->hasManyToMany(
	 *			'id',
	 *			'RobotsParts',
	 *			'robots_id',
	 *			'parts_id',
	 *			'Parts',
	 *			'id'
	 *		);
	 *   }
	 *}
	 *</code>
	 *
	 * @param mixed $fields
	 * @param string $intermediateModel
	 * @param mixed $intermediateFields
	 * @param mixed $intermediateReferencedFields
	 * @param string $referenceModel
	 * @param mixed $referencedFields
	 * @param array $options
	 * @param string $referencedModel
	 * 
	 * @return Relation
	 */
	protected function hasManyToMany($fields, $intermediateModel, $intermediateFields, $intermediateReferencedFields, $referenceModel, $referencedFields, $options=null) {}

	/**
	 * Setups a behavior in a model
	 *
	 *<code>
	 *<?php
	 *
	 *use Phalcon\Mvc\Model\Behavior\Timestampable;
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *		$this->addBehavior(new Timestampable(array(
	 *			'onCreate' => array(
	 *				'field' => 'created_at',
	 *				'format' => 'Y-m-d'
	 *			)
	 *		)));
	 *   }
	 *}
	 *</code>
	 * 
	 * @param BehaviorInterface $behavior
	 *
	 * @return void
	 */
	public function addBehavior(BehaviorInterface $behavior) {}

	/**
	 * Sets if the model must keep the original record snapshot in memory
	 *
	 *<code>
	 *<?php
	 *
	 *class Robots extends \Phalcon\Mvc\Model
	 *{
	 *
	 *   public function initialize()
	 *   {
	 *		$this->keepSnapshots(true);
	 *   }
	 *}
	 *</code>
	 * 
	 * @param boolean $keepSnapshot
	 *
	 * @return void
	 */
	protected function keepSnapshots($keepSnapshot) {}

	/**
	 * Sets the record's snapshot data.
	 * This method is used internally to set snapshot data when the model was set up to keep snapshot data
	 * 
	 * @param array $data
	 * @param array $columnMap
	 *
	 *
	 * @return mixed
	 */
	public function setSnapshotData(array $data, $columnMap=null) {}

	/**
		 * Build the snapshot based on a column map
		 *
	 * @return boolean
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
	 * @param mixed $fieldName
	 *
	 *
	 * @return boolean
	 */
	public function hasChanged($fieldName=null) {}

	/**
		 * Dirty state must be DIRTY_PERSISTENT to make the checking
		 *
	 * @return array
	 */
	public function getChangedFields() {}

	/**
		 * Dirty state must be DIRTY_PERSISTENT to make the checking
	 * 
	 * @param boolean $dynamicUpdate
		 *
	 * @return void
	 */
	protected function useDynamicUpdate($dynamicUpdate) {}

	/**
	 * Returns related records based on defined relations
	 *
	 * @param string $alias
	 * @param array $arguments
	 * 
	 * @return \ResultsetInterface
	 */
	public function getRelated($alias, $arguments=null) {}

	/**
		 * Query the relation by alias
	 * 
	 * @param string $modelName
	 * @param string $method
	 * @param mixed $arguments
		 *
	 * @return mixed
	 */
	protected function _getRelatedRecords($modelName, $method, $arguments) {}

	/**
		 * Calling find/findFirst if the method starts with "get"
	 * 
	 * @param string $method
	 * @param $arguments
		 *
	 * @return mixed
	 */
	public function __call($method, $arguments) {}

	/**
		 * Check if there is a default action using the magic getter
	 * 
	 * @param string $method
	 * @param $arguments
		 *
	 * @return mixed
	 */
	public static function __callStatic($method, $arguments=null) {}

	/**
		 * Check if the method starts with "findFirst"
	 * 
	 * @param string $property
	 * @param $value
		 *
	 * @return mixed
	 */
	public function __set($property, $value) {}

	/**
		 * Values are probably relationships if they are objects
	 * 
	 * @param string $property
		 *
	 * @return mixed
	 */
	public function __get($property) {}

	/**
		 * Check if the property is a relationship
	 * 
	 * @param string $property
		 *
	 * @return boolean
	 */
	public function __isset($property) {}

	/**
		 * Check if the property is a relationship
		 *
	 * @return string
	 */
	public function serialize() {}

	/**
		 * Use the standard serialize function to serialize the array data
	 * 
	 * @param string $data
		 *
	 * @return void
	 */
	public function unserialize($data) {}

	/**
			 * Obtain the default DI
			 *
	 * @return array
	 */
	public function dump() {}

	/**
	 * Returns the instance as an array representation
	 *
	 *<code>
	 * print_r($robot->toArray());
	 *</code>
	 *
	 * @param $columns
	 * 
	 * @return array
	 */
	public function toArray($columns=null) {}

	/**
			 * Check if the columns must be renamed
	 * 
	 * @param array $options
			 *
	 * @return void
	 */
	public static function setup(array $options) {}

	/**
		 * Enables/Disables globally the internal events
		 *
	 * @return void
	 */
	public function reset() {}

}
