<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Collection
	 *
	 * This component implements a high level abstraction for NoSQL databases which
	 * works with documents
	 */
	
	class Collection implements \Phalcon\Mvc\CollectionInterface, \Phalcon\DI\InjectionAwareInterface, \Serializable {

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

		/**
		 * \Phalcon\Mvc\Model constructor
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @param \Phalcon\Mvc\Collection\ManagerInterface $modelsManager
		 */
		final public function __construct($dependencyInjector=null){ }


		/**
		 * Sets a value for the _id property, creates a MongoId object if needed
		 *
		 * @param mixed $id
		 */
		public function setId($id){ }


		/**
		 * Returns the value of the _id property
		 *
		 * @return \MongoId
		 */
		public function getId(){ }


		/**
		 * Sets the dependency injection container
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the dependency injection container
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Sets a custom events manager
		 *
		 * @param \Phalcon\Events\ManagerInterface $eventsManager
		 */
		protected function setEventsManager($eventsManager){ }


		/**
		 * Returns the custom events manager
		 *
		 * @return \Phalcon\Events\ManagerInterface
		 */
		protected function getEventsManager(){ }


		/**
		 * Returns the models manager related to the entity instance
		 *
		 * @return \Phalcon\Mvc\Model\ManagerInterface
		 */
		public function getModelsManager(){ }


		/**
		 * Returns an array with reserved properties that cannot be part of the insert/update
		 *
		 * @return array
		 */
		public function getReservedAttributes(){ }


		/**
		 * Sets if a model must use implicit objects ids
		 *
		 * @param boolean $useImplicitObjectIds
		 */
		protected function useImplicitObjectIds(){ }


		/**
		 * Sets collection name which model should be mapped
		 *
		 * @param string $source
		 * @return \Phalcon\Mvc\Collection
		 */
		protected function setSource(){ }


		/**
		 * Returns collection name mapped in the model
		 *
		 * @return string
		 */
		public function getSource(){ }


		/**
		 * Sets the DependencyInjection connection service name
		 *
		 * @param string $connectionService
		 * @return \Phalcon\Mvc\Model
		 */
		public function setConnectionService($connectionService){ }


		/**
		 * Returns DependencyInjection connection service
		 *
		 * @return string
		 */
		public function getConnectionService(){ }


		/**
		 * Retrieves a database connection
		 *
		 * @return \MongoDb
		 */
		public function getConnection(){ }


		/**
		 * Reads an attribute value by its name
		 *
		 *<code>
		 *	echo $robot->readAttribute('name');
		 *</code>
		 *
		 * @param string $attribute
		 * @return mixed
		 */
		public function readAttribute($attribute){ }


		/**
		 * Writes an attribute value by its name
		 *
		 *<code>
		 *	$robot->writeAttribute('name', 'Rosey');
		 *</code>
		 *
		 * @param string $attribute
		 * @param mixed $value
		 */
		public function writeAttribute($attribute, $value){ }


		/**
		 * Returns a cloned collection
		 *
		 * @param \Phalcon\Mvc\Collection $collection
		 * @param array $document
		 * @return \Phalcon\Mvc\Collection
		 */
		public static function cloneResult($collection, $document){ }


		/**
		 * Returns a collection resultset
		 *
		 * @param array $params
		 * @param \Phalcon\Mvc\Collection $collection
		 * @param \MongoDb $connection
		 * @param boolean $unique
		 * @return array
		 */
		protected static function _getResultset(){ }


		/**
		 * Perform a count over a resultset
		 *
		 * @param array $params
		 * @param \Phalcon\Mvc\Collection $collection
		 * @param \MongoDb $connection
		 * @return int
		 */
		protected static function _getGroupResultset(){ }


		/**
		 * Executes internal hooks before save a document
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @param boolean $disableEvents
		 * @param boolean $exists
		 * @return boolean
		 */
		protected function _preSave(){ }


		/**
		 * Executes internal events after save a document
		 *
		 * @param boolean $disableEvents
		 * @param boolean $success
		 * @param boolean $exists
		 * @return boolean
		 */
		protected function _postSave(){ }


		/**
		 * Executes validators on every validation call
		 *
		 *<code>
		 *use \Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
		 *
		 *class Subscriptors extends \Phalcon\Mvc\Collection
		 *{
		 *
		 *	public function validation()
		 *	{
		 *		$this->validate(new ExclusionIn(array(
		 *			'field' => 'status',
		 *			'domain' => array('A', 'I')
		 *		)));
		 *		if ($this->validationHasFailed() == true) {
		 *			return false;
		 *		}
		 *	}
		 *
		 *}
		 *</code>
		 *
		 * @param object $validator
		 */
		protected function validate(){ }


		/**
		 * Check whether validation process has generated any messages
		 *
		 *<code>
		 *use \Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
		 *
		 *class Subscriptors extends \Phalcon\Mvc\Collection
		 *{
		 *
		 *	public function validation()
		 *	{
		 *		$this->validate(new ExclusionIn(array(
		 *			'field' => 'status',
		 *			'domain' => array('A', 'I')
		 *		)));
		 *		if ($this->validationHasFailed() == true) {
		 *			return false;
		 *		}
		 *	}
		 *
		 *}
		 *</code>
		 *
		 * @return boolean
		 */
		public function validationHasFailed(){ }


		/**
		 * Fires an internal event
		 *
		 * @param string $eventName
		 * @return boolean
		 */
		public function fireEvent($eventName){ }


		/**
		 * Fires an internal event that cancels the operation
		 *
		 * @param string $eventName
		 * @return boolean
		 */
		public function fireEventCancel($eventName){ }


		/**
		 * Cancel the current operation
		 *
		 * @return boolean
		 */
		protected function _cancelOperation(){ }


		/**
		 * Checks if the document exists in the collection
		 *
		 * @param \MongoCollection $collection
		 */
		protected function _exists(){ }


		/**
		 * Returns all the validation messages
		 *
		 * <code>
		 *$robot = new Robots();
		 *$robot->type = 'mechanical';
		 *$robot->name = 'Astro Boy';
		 *$robot->year = 1952;
		 *if ($robot->save() == false) {
		 *	echo "Umh, We can't store robots right now ";
		 *	foreach ($robot->getMessages() as $message) {
		 *		echo $message;
		 *	}
		 *} else {
		 *	echo "Great, a new robot was saved successfully!";
		 *}
		 * </code>
		 *
		 * @return \Phalcon\Mvc\Model\MessageInterface[]
		 */
		public function getMessages(){ }


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
		 *				$message = new Message("Sorry, but a robot cannot be named Peter");
		 *				$this->appendMessage($message);
		 *			}
		 *		}
		 *	}
		 *</code>
		 *
		 * @param \Phalcon\Mvc\Model\MessageInterface $message
		 */
		public function appendMessage($message){ }


		/**
		 * Creates/Updates a collection based on the values in the attributes
		 *
		 * @return boolean
		 */
		public function save(){ }


		/**
		 * Find a document by its id (_id)
		 *
		 * @param string|\MongoId $id
		 * @return \Phalcon\Mvc\Collection
		 */
		public static function findById($id){ }


		/**
		 * Allows to query the first record that match the specified conditions
		 *
		 * <code>
		 *
		 * //What's the first robot in the robots table?
		 * $robot = Robots::findFirst();
		 * echo "The robot name is ", $robot->name, "\n";
		 *
		 * //What's the first mechanical robot in robots table?
		 * $robot = Robots::findFirst(array(
		 *     array("type" => "mechanical")
		 * ));
		 * echo "The first mechanical robot name is ", $robot->name, "\n";
		 *
		 * //Get first virtual robot ordered by name
		 * $robot = Robots::findFirst(array(
		 *     array("type" => "mechanical"),
		 *     "order" => array("name" => 1)
		 * ));
		 * echo "The first virtual robot name is ", $robot->name, "\n";
		 *
		 * </code>
		 *
		 * @param array $parameters
		 * @return array
		 */
		public static function findFirst($parameters=null){ }


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
		 * echo "There are ", count($robots), "\n";
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
		 * @param 	array $parameters
		 * @return  array
		 */
		public static function find($parameters=null){ }


		/**
		 * Perform a count over a collection
		 *
		 *<code>
		 * echo 'There are ', Robots::count(), ' robots';
		 *</code>
		 *
		 * @param array $parameters
		 * @return array
		 */
		public static function count($parameters=null){ }


		/**
		 * Perform an aggregation using the Mongo aggregation framework
		 *
		 * @param array $parameters
		 * @return array
		 */
		public static function aggregate($parameters){ }


		/**
		 * Allows to perform a summatory group for a column in the collection
		 *
		 * @param string $field
		 * @param array $conditions
		 * @param string $finalize
		 * @return array
		 */
		public static function summatory($field, $conditions=null, $finalize=null){ }


		/**
		 * Deletes a model instance. Returning true on success or false otherwise.
		 *
		 * <code>
		 *
		 *	$robot = Robots::findFirst();
		 *	$robot->delete();
		 *
		 *	foreach (Robots::find() as $robot) {
		 *		$robot->delete();
		 *	}
		 * </code>
		 *
		 * @return boolean
		 */
		public function delete(){ }


		/**
		 * Returns the instance as an array representation
		 *
		 *<code>
		 * print_r($robot->toArray());
		 *</code>
		 *
		 * @return array
		 */
		public function toArray(){ }


		/**
		 * Serializes the object ignoring connections or protected properties
		 *
		 * @return string
		 */
		public function serialize(){ }


		/**
		 * Unserializes the object from a serialized string
		 *
		 * @param string $data
		 */
		public function unserialize($serialized=null){ }


		/**
		 * Runs JavaScript code on the database server.
		 *
		 * <code>
		 *
		 * $ret = Robots::execute("function() { return 'Hello, world!';}");
		 * echo $ret['retval'], "\n";
		 *
		 * </code>
		 *
		 * @param mixed $code
		 * @param array $args
		 * @return array
		 */
		public static function execute($code, $args=null){ }

	}
}
