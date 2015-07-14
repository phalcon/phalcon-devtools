<?php

namespace Phalcon\Mvc;

use Phalcon\Di;
use Phalcon\DiInterface;
use Phalcon\Mvc\Collection\Document;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Collection\ManagerInterface;
use Phalcon\Mvc\Collection\BehaviorInterface;
use Phalcon\Mvc\Collection\Exception;
use Phalcon\Mvc\Model\MessageInterface;


abstract class Collection implements EntityInterface, CollectionInterface, InjectionAwareInterface, \Serializable
{

	const OP_NONE = 0;

	const OP_CREATE = 1;

	const OP_UPDATE = 2;

	const OP_DELETE = 3;



	public $_id;

	protected $_dependencyInjector;

	protected $_modelsManager;

	protected $_source;

	protected $_operationMade;

	protected $_connection;

	protected $_errorMessages;

	protected static $_reserved;

	protected static $_disableEvents;

	protected $_skipped = false;



	/**
	 * Phalcon\Mvc\Collection constructor
	 * 
	 * @param DiInterface $dependencyInjector
	 * @param ManagerInterface $modelsManager
	 */
	public final function __construct(DiInterface $dependencyInjector=null, ManagerInterface $modelsManager=null) {}

	/**
		 * We use a default DI if the user doesn't define one
	 * 
	 * @param $id
		 *
	 * @return void
	 */
	public function setId($id) {}

	/**
			 * Check if the model use implicit ids
			 *
	 * @return mixed
	 */
	public function getId() {}

	/**
	 * Sets the dependency injection container
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
	 * @param ManagerInterface $eventsManager
	 *
	 * @return void
	 */
	protected function setEventsManager(ManagerInterface $eventsManager) {}

	/**
	 * Returns the custom events manager
	 *
	 * @return ManagerInterface
	 */
	protected function getEventsManager() {}

	/**
	 * Returns the models manager related to the entity instance
	 *
	 * @return ManagerInterface
	 */
	public function getCollectionManager() {}

	/**
	 * Returns an array with reserved properties that cannot be part of the insert/update
	 *
	 * @return array
	 */
	public function getReservedAttributes() {}

	/**
	 * Sets if a model must use implicit objects ids
	 * 
	 * @param boolean $useImplicitObjectIds
	 *
	 * @return void
	 */
	protected function useImplicitObjectIds($useImplicitObjectIds) {}

	/**
	 * Sets collection name which model should be mapped
	 * 
	 * @param string $source
	 *
	 * @return Collection
	 */
	protected function setSource($source) {}

	/**
	 * Returns collection name mapped in the model
	 *
	 * @return string
	 */
	public function getSource() {}

	/**
	 * Sets the DependencyInjection connection service name
	 * 
	 * @param string $connectionService
	 *
	 * @return Collection
	 */
	public function setConnectionService($connectionService) {}

	/**
	 * Returns DependencyInjection connection service
	 *
	 * @return string
	 */
	public function getConnectionService() {}

	/**
	 * Retrieves a database connection
	 *
	 * @return mixed
	 */
	public function getConnection() {}

	/**
	 * Reads an attribute value by its name
	 *
	 *<code>
	 *	echo $robot->readAttribute('name');
	 *</code>
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
	 *	$robot->writeAttribute('name', 'Rosey');
	 *</code>
	 * 
	 * @param string $attribute
	 * @param mixed $value
	 *
	 *
	 * @return void
	 */
	public function writeAttribute($attribute, $value) {}

	/**
	 * Returns a cloned collection
	 * 
	 * @param CollectionInterface $collection
	 * @param array $document
	 *
	 * @return CollectionInterface
	 */
	public static function cloneResult(CollectionInterface $collection, array $document) {}

	/**
	 * Returns a collection resultset
	 *
	 * @param mixed $params
	 * @param CollectionInterface $collection
	 * @param \MongoDb $connection
	 * @param boolean $unique
	 * 
	 * @return mixed
	 */
	protected static function _getResultset($params, CollectionInterface $collection, $connection, $unique) {}

	/**
		 * Convert the string to an array
	 * 
	 * @param $params
	 * @param Collection $collection
	 * @param $connection
		 *
	 * @return int
	 */
	protected static function _getGroupResultset($params, Collection $collection, $connection) {}

	/**
		 * Convert the string to an array
	 * 
	 * @param $dependencyInjector
	 * @param boolean $disableEvents
	 * @param boolean $exists
		 *
	 * @return boolean
	 */
	protected final function _preSave($dependencyInjector, $disableEvents, $exists) {}

	/**
		 * Run Validation Callbacks Before
	 * 
	 * @param boolean $disableEvents
	 * @param boolean $success
	 * @param boolean $exists
		 *
	 * @return boolean
	 */
	protected final function _postSave($disableEvents, $success, $exists) {}

	/**
	 * Executes validators on every validation call
	 *
	 *<code>
	 *use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
	 *
	 *class Subscriptors extends \Phalcon\Mvc\Collection
	 *{
	 *
	 *	public function validation()
	 *	{
	 *		this->validate(new ExclusionIn(array(
	 *			'field' => 'status',
	 *			'domain' => array('A', 'I')
	 *		)));
	 *		if (this->validationHasFailed() == true) {
	 *			return false;
	 *		}
	 *	}
	 *
	 *}
	 *</code>
	 * 
	 * @param Model\ValidatorInterface $validator
	 *
	 * @return void
	 */
	protected function validate(Model\ValidatorInterface $validator) {}

	/**
	 * Check whether validation process has generated any messages
	 *
	 *<code>
	 *use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
	 *
	 *class Subscriptors extends \Phalcon\Mvc\Collection
	 *{
	 *
	 *	public function validation()
	 *	{
	 *		this->validate(new ExclusionIn(array(
	 *			'field' => 'status',
	 *			'domain' => array('A', 'I')
	 *		)));
	 *		if (this->validationHasFailed() == true) {
	 *			return false;
	 *		}
	 *	}
	 *
	 *}
	 *</code>
	 *
	 * @return boolean
	 */
	public function validationHasFailed() {}

	/**
	 * Fires an internal event
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
	 * @param boolean $disableEvents
		 *
	 * @return boolean
	 */
	protected function _cancelOperation($disableEvents) {}

	/**
	 * Checks if the document exists in the collection
	 *
	 * @param \MongoCollection $collection
	 * 
	 * @return boolean
	 */
	protected function _exists($collection) {}

	/**
			 * Check if the model use implicit ids
			 *
	 * @return MessageInterface[]
	 */
	public function getMessages() {}

	/**
	 * Appends a customized message on the validation process
	 *
	 *<code>
	 *	use \Phalcon\Mvc\Model\Message as Message;
	 *
	 *	class Robots extends \Phalcon\Mvc\Model
	 *	{
	 *
	 *		public function beforeSave()
	 *		{
	 *			if ($this->name == 'Peter') {
	 *				message = new Message("Sorry, but a robot cannot be named Peter");
	 *				$this->appendMessage(message);
	 *			}
	 *		}
	 *	}
	 *</code>
	 * 
	 * @param MessageInterface $message
	 *
	 * @return void
	 */
	public function appendMessage(MessageInterface $message) {}

	/**
	 * Creates/Updates a collection based on the values in the atributes
	 *
	 * @return boolean
	 */
	public function save() {}

	/**
		 * Choose a collection according to the collection name
	 * 
	 * @param $id
		 *
	 * @return Collection
	 */
	public static function findById($id) {}

	/**
			 * Check if the model use implicit ids
	 * 
	 * @param array $parameters
			 *
	 * @return array
	 */
	public static function findFirst(array $parameters=null) {}

	/**
	 * Allows to query a set of records that match the specified conditions
	 *
	 * <code>
	 *
	 * //How many robots are there?
	 * $robots = Robots::find();
	 * echo "There are ", count($robots), "\n";
	 *
	 * //How many mechanical robots are there?
	 * $robots = Robots::find(array(
	 *     array("type" => "mechanical")
	 * ));
	 * echo "There are ", count(robots), "\n";
	 *
	 * //Get and print virtual robots ordered by name
	 * $robots = Robots::findFirst(array(
	 *     array("type" => "virtual"),
	 *     "order" => array("name" => 1)
	 * ));
	 * foreach ($robots as $robot) {
	 *	   echo $robot->name, "\n";
	 * }
	 *
	 * //Get first 100 virtual robots ordered by name
	 * $robots = Robots::find(array(
	 *     array("type" => "virtual"),
	 *     "order" => array("name" => 1),
	 *     "limit" => 100
	 * ));
	 * foreach ($robots as $robot) {
	 *	   echo $robot->name, "\n";
	 * }
	 * </code>
	 * 
	 * @param array $parameters
	 *
	 * @return array
	 */
	public static function find(array $parameters=null) {}

	/**
	 * Perform a count over a collection
	 *
	 *<code>
	 * echo 'There are ', Robots::count(), ' robots';
	 *</code>
	 * 
	 * @param array $parameters
	 *
	 * @return array
	 */
	public static function count(array $parameters=null) {}

	/**
	 * Perform an aggregation using the Mongo aggregation framework
	 * 
	 * @param array $parameters
	 *
	 * @return array
	 */
	public static function aggregate(array $parameters=null) {}

	/**
	 * Allows to perform a summatory group for a column in the collection
	 * 
	 * @param string $field
	 * @param $conditions
	 * @param $finalize
	 *
	 * @return array
	 */
	public static function summatory($field, $conditions=null, $finalize=null) {}

	/**
		 * Uses a javascript hash to group the results
		 *
	 * @return boolean
	 */
	public function delete() {}

	/**
		 * Get the \MongoCollection
	 * 
	 * @param BehaviorInterface $behavior
		 *
	 * @return void
	 */
	protected function addBehavior(BehaviorInterface $behavior) {}

	/**
	 * Skips the current operation forcing a success state
	 * 
	 * @param boolean $skip
	 *
	 * @return void
	 */
	public function skipOperation($skip) {}

	/**
	 * Returns the instance as an array representation
	 *
	 *<code>
	 * print_r($robot->toArray());
	 *</code>
	 *
	 * @return array
	 */
	public function toArray() {}

	/**
		 * Get an array with the values of the object
		 * We only assign values to the public properties
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

}
