<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Collection
	 *
	 * This component implements a high level abstraction for NoSQL databases which
	 * works with documents
	 */
	
	class Collection {

		const OP_NONE = 0;

		const OP_CREATE = 1;

		const OP_UPDATE = 2;

		const OP_DELETE = 3;

		protected $_source;

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_operationMade;

		protected $_connectionService;

		protected $_connection;

		protected $_errorMessages;

		protected static $_reserved;

		protected static $_disableEvents;

		/**
		 * \Phalcon\Mvc\Collection
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function __construct($dependencyInjector=null){ }


		/**
		 * Sets a value for the _id propery, creates a MongoId object if needed
		 *
		 * @param mixed $id
		 */
		public function setId($id){ }


		/**
		 * Returns the value of the _id property
		 *
		 * @return MongoId
		 */
		public function getId(){ }


		/**
		 * Sets the dependency injection container
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the dependency injection container
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Sets the event manager
		 *
		 * @param \Phalcon\Events\Manager $eventsManager
		 */
		public function setEventsManager($eventsManager){ }


		/**
		 * Returns the internal event manager
		 *
		 * @return \Phalcon\Events\Manager
		 */
		public function getEventsManager(){ }


		/**
		 * Returns an array with reserved properties that cannot be part of the insert/update
		 *
		 * @return array
		 */
		public function getReservedAttributes(){ }


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
		 * Sets a service in the services container that returns the Mongo database
		 *
		 * @param string $connectionService
		 */
		public function setConnectionService($connectionService){ }


		/**
		 * Retrieves a database connection
		 *
		 * @return MongoDb
		 */
		public function getConnection(){ }


		/**
		 * Reads an attribute value by its name
		 *
		 * <code> echo $robot->readAttribute('name');</code>
		 *
		 * @param string $attribute
		 * @return mixed
		 */
		public function readAttribute($attribute){ }


		/**
		 * Writes an attribute value by its name
		 *
		 * <code>$robot->writeAttribute('name', 'Rosey');</code>
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
		protected static function dumpResult(){ }


		/**
		 * Returns a collection resultset
		 *
		 * @param array $params
		 * @param \Phalcon\Mvc\Collection $collection
		 * @param MongoDb $connection
		 * @param boolean $unique
		 * @return array
		 */
		protected static function _getResultset(){ }


		/**
		 * Executes internal hooks before save a document
		 *
		 * @param \Phalcon\DI $dependencyInjector
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
		 *  {
		 * 		$this->validate(new ExclusionIn(array(
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
		protected function _callEvent(){ }


		/**
		 * Fires an internal event that cancels the operation
		 *
		 * @param string $eventName
		 * @return boolean
		 */
		protected function _callEventCancel(){ }


		/**
		 * Cancel the current operation
		 *
		 * @return boolean
		 */
		protected function _cancelOperation(){ }


		/**
		 * Checks if the document exists in the collection
		 *
		 * @param MongoCollection $collection
		 */
		protected function _exists(){ }


		/**
		 *
		 */
		public function save(){ }


		/**
		 * Find a document by its id
		 *
		 * @param string $id
		 * @return \Phalcon\Mvc\Collection
		 */
		public static function findById($id){ }


		/**
		 * Allows to query the first record that match the specified conditions
		 *
		 * <code>
		 *
		 * //What's the first robot in robots table?
		 * $robot = Robots::findFirst();
		 * echo "The robot name is ", $robot->name;
		 *
		 * //What's the first mechanical robot in robots table?
		 * $robot = Robots::findFirst(array(
		 *     array("type" => "mechanical")
		 * ));
		 * echo "The first mechanical robot name is ", $robot->name;
		 *
		 * //Get first virtual robot ordered by name
		  * $robot = Robots::findFirst(array(
		 *     array("type" => "mechanical"),
		 *     "order" => array("name" => 1)
		 * ));
		 * echo "The first virtual robot name is ", $robot->name;
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
		 * echo "There are ", count($robots);
		 *
		 * //How many mechanical robots are there?
		 * $robots = Robots::find(array(
		 *     array("type" => "mechanical")
		 * ));
		 * echo "There are ", count($robots);
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
		 *
		 */
		public static function count($parameters=null){ }


		/**
		 * Deletes a model instance. Returning true on success or false otherwise.
		 *
		 * <code>
		 *$robot = Robots::findFirst();
		 *$robot->delete();
		 *
		 *foreach(Robots::find() as $robot){
		 *   $robot->delete();
		 *}
		 * </code>
		 *
		 * @return boolean
		 */
		public function delete(){ }

	}
}
