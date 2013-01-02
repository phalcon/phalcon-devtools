<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\CollectionInterface initializer
	 */
	
	interface CollectionInterface {

		/**
		 * \Phalcon\Mvc\Collection
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function __construct($dependencyInjector=null);


		/**
		 * Sets a value for the _id propery, creates a MongoId object if needed
		 *
		 * @param mixed $id
		 */
		public function setId($id);


		/**
		 * Returns the value of the _id property
		 *
		 * @return MongoId
		 */
		public function getId();


		/**
		 * Returns an array with reserved properties that cannot be part of the insert/update
		 *
		 * @return array
		 */
		public function getReservedAttributes();


		/**
		 * Returns collection name mapped in the model
		 *
		 * @return string
		 */
		public function getSource();


		/**
		 * Sets a service in the services container that returns the Mongo database
		 *
		 * @param string $connectionService
		 */
		public function setConnectionService($connectionService);


		/**
		 * Retrieves a database connection
		 *
		 * @return MongoDb
		 */
		public function getConnection();


		/**
		 * Reads an attribute value by its name
		 *
		 * <code>
		 *	echo $robot->readAttribute('name');
		 * </code>
		 *
		 * @param string $attribute
		 * @return mixed
		 */
		public function readAttribute($attribute);


		/**
		 * Writes an attribute value by its name
		 *
		 * <code>
		 *	$robot->writeAttribute('name', 'Rosey');
		 * </code>
		 *
		 * @param string $attribute
		 * @param mixed $value
		 */
		public function writeAttribute($attribute, $value);


		/**
		 * Returns a cloned collection
		 *
		 * @param \Phalcon\Mvc\Collection $collection
		 * @param array $document
		 * @return \Phalcon\Mvc\Collection
		 */
		public function dumpResult($collection, $document);


		/**
		 * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
		 *
		 * @param string $eventName
		 * @return boolean
		 */
		public function fireEvent($eventName);


		/**
		 * Fires an event, implicitly listeners in the events manager are notified
		 * This method stops if one of the callbacks/listeners returns boolean false
		 *
		 * @param string $eventName
		 * @return boolean
		 */
		public function fireEventCancel($eventName);


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
		public function validationHasFailed();


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
		public function getMessages();


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
		 *				$message = new Message("Sorry, but a robot cannot be named Peter");
		 *				$this->appendMessage($message);
		 *			}
		 *		}
		 *	}
		 *</code>
		 *
		 * @param \Phalcon\Mvc\Model\MessageInterface $message
		 */
		public function appendMessage($message);


		/**
		 * Creates/Updates a collection based on the values in the atributes
		 *
		 * @return boolean
		 */
		public function save();


		/**
		 * Find a document by its id
		 *
		 * @param string $id
		 * @return \Phalcon\Mvc\Collection
		 */
		public function findById($id);


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
		public function findFirst($parameters=null);


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
		public function find($parameters=null);


		/**
		 * Perform a count over a collection
		 *
		 * @param array $parameters
		 * @return array
		 */
		public function count($parameters=null);


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
		public function delete();

	}
}
