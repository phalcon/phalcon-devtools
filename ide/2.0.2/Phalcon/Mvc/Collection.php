<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Collection
	 *
	 * This component implements a high level abstraction for NoSQL databases which
	 * works with documents
	 */
	
	abstract class Collection implements \Phalcon\Mvc\CollectionInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable {

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
		 * \Phalcon\Mvc\Collection constructor
		 */
		final public function __construct(\Phalcon\DiInterface $dependencyInjector=null, \Phalcon\Mvc\Collection\ManagerInterface $modelsManager=null){ }


		/**
		 * Sets a value for the _id property, creates a MongoId object if needed
		 *
		 * @param mixed id
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
		 */
		public function setDI(\Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Returns the dependency injection container
		 */
		public function getDI(){ }


		/**
		 * Sets a custom events manager
		 */
		protected function setEventsManager(\Phalcon\Mvc\Collection\ManagerInterface $eventsManager){ }


		/**
		 * Returns the custom events manager
		 */
		protected function getEventsManager(){ }


		/**
		 * Returns the models manager related to the entity instance
		 */
		public function getCollectionManager(){ }


		/**
		 * Returns an array with reserved properties that cannot be part of the insert/update
		 */
		public function getReservedAttributes(){ }


		/**
		 * Sets if a model must use implicit objects ids
		 */
		protected function useImplicitObjectIds($useImplicitObjectIds){ }


		/**
		 * Sets collection name which model should be mapped
		 */
		protected function setSource($source){ }


		/**
		 * Returns collection name mapped in the model
		 */
		public function getSource(){ }


		/**
		 * Sets the DependencyInjection connection service name
		 */
		public function setConnectionService($connectionService){ }


		/**
		 * Returns DependencyInjection connection service
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
		 *	echo robot->readAttribute('name');
		 *</code>
		 *
		 * @param string attribute
		 * @return mixed
		 */
		public function readAttribute($attribute){ }


		/**
		 * Writes an attribute value by its name
		 *
		 *<code>
		 *	robot->writeAttribute('name', 'Rosey');
		 *</code>
		 *
		 * @param string attribute
		 * @param mixed value
		 */
		public function writeAttribute($attribute, $value){ }


		/**
		 * Returns a cloned collection
		 */
		public static function cloneResult(\Phalcon\Mvc\CollectionInterface $collection, $document){ }


		/**
		 * Returns a collection resultset
		 *
		 * @param array params
		 * @param \Phalcon\Mvc\Collection collection
		 * @param \MongoDb connection
		 * @param boolean unique
		 * @return array
		 */
		protected static function _getResultset($params, \Phalcon\Mvc\CollectionInterface $collection, $connection, $unique){ }


		/**
		 * Perform a count over a resultset
		 *
		 * @param array params
		 * @param \Phalcon\Mvc\Collection collection
		 * @param \MongoDb connection
		 * @return int
		 */
		protected static function _getGroupResultset($params, \Phalcon\Mvc\Collection $collection, $connection){ }


		/**
		 * Executes internal hooks before save a document
		 *
		 * @param \Phalcon\DiInterface dependencyInjector
		 * @param boolean disableEvents
		 * @param boolean exists
		 * @return boolean
		 */
		final protected function _preSave($dependencyInjector, $disableEvents, $exists){ }


		/**
		 * Executes internal events after save a document
		 */
		final protected function _postSave($disableEvents, $success, $exists){ }


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
		 */
		protected function validate(\Phalcon\Mvc\Model\ValidatorInterface $validator){ }


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
		 */
		public function validationHasFailed(){ }


		/**
		 * Fires an internal event
		 */
		public function fireEvent($eventName){ }


		/**
		 * Fires an internal event that cancels the operation
		 */
		public function fireEventCancel($eventName){ }


		/**
		 * Cancel the current operation
		 */
		protected function _cancelOperation($disableEvents){ }


		/**
		 * Checks if the document exists in the collection
		 *
		 * @param \MongoCollection collection
		 * @return boolean
		 */
		protected function _exists($collection){ }


		/**
		 * Returns all the validation messages
		 *
		 * <code>
		 *robot = new Robots();
		 *robot->type = 'mechanical';
		 *robot->name = 'Astro Boy';
		 *robot->year = 1952;
		 *if (robot->save() == false) {
		 *	echo "Umh, We can't store robots right now ";
		 *	foreach (robot->getMessages() as message) {
		 *		echo message;
		 *	}
		 *} else {
		 *	echo "Great, a new robot was saved successfully!";
		 *}
		 * </code>
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
		 *			if (this->name == 'Peter') {
		 *				message = new Message("Sorry, but a robot cannot be named Peter");
		 *				this->appendMessage(message);
		 *			}
		 *		}
		 *	}
		 *</code>
		 */
		public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message){ }


		/**
		 * Creates/Updates a collection based on the values in the atributes
		 */
		public function save(){ }


		/**
		 * Find a document by its id (_id)
		 *
		 * @param string|\MongoId id
		 * @return \Phalcon\Mvc\Collection
		 */
		public static function findById($id){ }


		/**
		 * Allows to query the first record that match the specified conditions
		 *
		 * <code>
		 *
		 * //What's the first robot in the robots table?
		 * robot = Robots::findFirst();
		 * echo "The robot name is ", robot->name, "\n";
		 *
		 * //What's the first mechanical robot in robots table?
		 * robot = Robots::findFirst(array(
		 *     array("type" => "mechanical")
		 * ));
		 * echo "The first mechanical robot name is ", robot->name, "\n";
		 *
		 * //Get first virtual robot ordered by name
		 * robot = Robots::findFirst(array(
		 *     array("type" => "mechanical"),
		 *     "order" => array("name" => 1)
		 * ));
		 * echo "The first virtual robot name is ", robot->name, "\n";
		 *
		 * </code>
		 */
		public static function findFirst($parameters=null){ }


		/**
		 * Allows to query a set of records that match the specified conditions
		 *
		 * <code>
		 *
		 * //How many robots are there?
		 * robots = Robots::find();
		 * echo "There are ", count(robots), "\n";
		 *
		 * //How many mechanical robots are there?
		 * robots = Robots::find(array(
		 *     array("type" => "mechanical")
		 * ));
		 * echo "There are ", count(robots), "\n";
		 *
		 * //Get and print virtual robots ordered by name
		 * robots = Robots::findFirst(array(
		 *     array("type" => "virtual"),
		 *     "order" => array("name" => 1)
		 * ));
		 * foreach (robots as robot) {
		 *	   echo robot->name, "\n";
		 * }
		 *
		 * //Get first 100 virtual robots ordered by name
		 * robots = Robots::find(array(
		 *     array("type" => "virtual"),
		 *     "order" => array("name" => 1),
		 *     "limit" => 100
		 * ));
		 * foreach (robots as robot) {
		 *	   echo robot->name, "\n";
		 * }
		 * </code>
		 */
		public static function find($parameters=null){ }


		/**
		 * Perform a count over a collection
		 *
		 *<code>
		 * echo 'There are ', Robots::count(), ' robots';
		 *</code>
		 */
		public static function count($parameters=null){ }


		/**
		 * Perform an aggregation using the Mongo aggregation framework
		 */
		public static function aggregate($parameters=null){ }


		/**
		 * Allows to perform a summatory group for a column in the collection
		 *
		 * @param string field
		 * @param array conditions
		 * @param string finalize
		 * @return array
		 */
		public static function summatory($field, $conditions=null, $finalize=null){ }


		/**
		 * Deletes a model instance. Returning true on success or false otherwise.
		 *
		 * <code>
		 *
		 *	robot = Robots::findFirst();
		 *	robot->delete();
		 *
		 *	foreach (Robots::find() as robot) {
		 *		robot->delete();
		 *	}
		 * </code>
		 */
		public function delete(){ }


		/**
		 * Returns the instance as an array representation
		 *
		 *<code>
		 * print_r(robot->to[]);
		 *</code>
		 */
		public function toArray(){ }


		/**
		 * Serializes the object ignoring connections or protected properties
		 */
		public function serialize(){ }


		/**
		 * Unserializes the object from a serialized string
		 */
		public function unserialize($data){ }

	}
}
