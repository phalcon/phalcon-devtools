<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\Collection
 * This component implements a high level abstraction for NoSQL databases which
 * works with documents
 */
abstract class Collection implements \Phalcon\Mvc\EntityInterface, \Phalcon\Mvc\CollectionInterface, \Phalcon\Di\InjectionAwareInterface, \Serializable
{

    const OP_NONE = 0;


    const OP_CREATE = 1;


    const OP_UPDATE = 2;


    const OP_DELETE = 3;


    protected $_id;


    protected $_dependencyInjector;


    protected $_modelsManager;


    protected $_source;


    protected $_operationMade = 0;


    protected $_connection;


    protected $_errorMessages = array();


    static protected $_reserved;


    static protected $_disableEvents;


    protected $_skipped = false;


    /**
     * Phalcon\Mvc\Collection constructor
     *
     * @param mixed $dependencyInjector 
     * @param mixed $modelsManager 
     */
    public final function __construct(\Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Mvc\Collection\ManagerInterface $modelsManager = null) {}

    /**
     * Sets a value for the _id property, creates a MongoId object if needed
     *
     * @param mixed $id 
     */
    public function setId($id) {}

    /**
     * Returns the value of the _id property
     *
     * @return \MongoId 
     */
    public function getId() {}

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
    protected function setEventsManager(\Phalcon\Mvc\Collection\ManagerInterface $eventsManager) {}

    /**
     * Returns the custom events manager
     *
     * @return \Phalcon\Mvc\Collection\ManagerInterface 
     */
    protected function getEventsManager() {}

    /**
     * Returns the models manager related to the entity instance
     *
     * @return \Phalcon\Mvc\Collection\ManagerInterface 
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
     * @param bool $useImplicitObjectIds 
     */
    protected function useImplicitObjectIds($useImplicitObjectIds) {}

    /**
     * Sets collection name which model should be mapped
     *
     * @param string $source 
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
     * @return \MongoDb 
     */
    public function getConnection() {}

    /**
     * Reads an attribute value by its name
     * <code>
     * echo $robot->readAttribute('name');
     * </code>
     *
     * @param string $attribute 
     * @return mixed 
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
     * Returns a cloned collection
     *
     * @param mixed $collection 
     * @param array $document 
     * @return CollectionInterface 
     */
    public static function cloneResult(CollectionInterface $collection, array $document) {}

    /**
     * Returns a collection resultset
     *
     * @param array $params 
     * @param \Phalcon\Mvc\Collection $collection 
     * @param \MongoDb $connection 
     * @param boolean $unique 
     * @return array 
     */
    protected static function _getResultset($params, CollectionInterface $collection, $connection, $unique) {}

    /**
     * Perform a count over a resultset
     *
     * @param array $params 
     * @param \Phalcon\Mvc\Collection $collection 
     * @param \MongoDb $connection 
     * @return int 
     */
    protected static function _getGroupResultset($params, Collection $collection, $connection) {}

    /**
     * Executes internal hooks before save a document
     *
     * @param \Phalcon\DiInterface $dependencyInjector 
     * @param boolean $disableEvents 
     * @param boolean $exists 
     * @return boolean 
     */
    protected final function _preSave($dependencyInjector, $disableEvents, $exists) {}

    /**
     * Executes internal events after save a document
     *
     * @param bool $disableEvents 
     * @param bool $success 
     * @param bool $exists 
     * @return bool 
     */
    protected final function _postSave($disableEvents, $success, $exists) {}

    /**
     * Executes validators on every validation call
     * <code>
     * use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
     * class Subscriptors extends \Phalcon\Mvc\Collection
     * {
     * public function validation()
     * {
     * this->validate(new ExclusionIn(array(
     * 'field' => 'status',
     * 'domain' => array('A', 'I')
     * )));
     * if (this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     *
     * @param mixed $validator 
     */
    protected function validate(Model\ValidatorInterface $validator) {}

    /**
     * Check whether validation process has generated any messages
     * <code>
     * use Phalcon\Mvc\Model\Validator\ExclusionIn as ExclusionIn;
     * class Subscriptors extends \Phalcon\Mvc\Collection
     * {
     * public function validation()
     * {
     * this->validate(new ExclusionIn(array(
     * 'field' => 'status',
     * 'domain' => array('A', 'I')
     * )));
     * if (this->validationHasFailed() == true) {
     * return false;
     * }
     * }
     * }
     * </code>
     *
     * @return bool 
     */
    public function validationHasFailed() {}

    /**
     * Fires an internal event
     *
     * @param string $eventName 
     * @return bool 
     */
    public function fireEvent($eventName) {}

    /**
     * Fires an internal event that cancels the operation
     *
     * @param string $eventName 
     * @return bool 
     */
    public function fireEventCancel($eventName) {}

    /**
     * Cancel the current operation
     *
     * @param bool $disableEvents 
     * @return bool 
     */
    protected function _cancelOperation($disableEvents) {}

    /**
     * Checks if the document exists in the collection
     *
     * @param \MongoCollection $collection 
     * @return boolean 
     */
    protected function _exists($collection) {}

    /**
     * Returns all the validation messages
     * <code>
     * $robot = new Robots();
     * $robot->type = 'mechanical';
     * $robot->name = 'Astro Boy';
     * $robot->year = 1952;
     * if ($robot->save() == false) {
     * echo "Umh, We can't store robots right now ";
     * foreach ($robot->getMessages() as message) {
     * echo message;
     * }
     * } else {
     * echo "Great, a new robot was saved successfully!";
     * }
     * </code>
     *
     * @return MessageInterface[] 
     */
    public function getMessages() {}

    /**
     * Appends a customized message on the validation process
     * <code>
     * use \Phalcon\Mvc\Model\Message as Message;
     * class Robots extends \Phalcon\Mvc\Model
     * {
     * public function beforeSave()
     * {
     * if ($this->name == 'Peter') {
     * message = new Message("Sorry, but a robot cannot be named Peter");
     * $this->appendMessage(message);
     * }
     * }
     * }
     * </code>
     *
     * @param mixed $message 
     */
    public function appendMessage(\Phalcon\Mvc\Model\MessageInterface $message) {}

    /**
     * Shared Code for CU Operations
     * Prepares Collection
     */
    protected function prepareCU() {}

    /**
     * Creates/Updates a collection based on the values in the attributes
     *
     * @return bool 
     */
    public function save() {}

    /**
     * Creates a collection based on the values in the attributes
     *
     * @return bool 
     */
    public function create() {}

    /**
     * Creates a document based on the values in the attributes, if not found by criteria
     * Preferred way to avoid duplication is to create index on attribute
     * $robot = new Robot();
     * $robot->name = "MyRobot";
     * $robot->type = "Droid";
     * //create only if robot with same name and type does not exist
     * $robot->createIfNotExist( array( "name", "type" ) );
     *
     * @param array $criteria 
     * @return bool 
     */
    public function createIfNotExist(array $criteria) {}

    /**
     * Creates/Updates a collection based on the values in the attributes
     *
     * @return bool 
     */
    public function update() {}

    /**
     * Find a document by its id (_id)
     * <code>
     * // Find user by using \MongoId object
     * $user = Users::findById(new \MongoId('545eb081631d16153a293a66'));
     * // Find user by using id as sting
     * $user = Users::findById('45cbc4a0e4123f6920000002');
     * // Validate input
     * if ($user = Users::findById($_POST['id'])) {
     * // ...
     * }
     * </code>
     *
     * @param mixed $id 
     * @return null|Collection 
     */
    public static function findById($id) {}

    /**
     * Allows to query the first record that match the specified conditions
     * <code>
     * // What's the first robot in the robots table?
     * $robot = Robots::findFirst();
     * echo 'The robot name is ', $robot->name, "\n";
     * // What's the first mechanical robot in robots table?
     * $robot = Robots::findFirst([
     * ['type' => 'mechanical']
     * ]);
     * echo 'The first mechanical robot name is ', $robot->name, "\n";
     * // Get first virtual robot ordered by name
     * $robot = Robots::findFirst([
     * ['type' => 'mechanical'],
     * 'order' => ['name' => 1]
     * ]);
     * echo 'The first virtual robot name is ', $robot->name, "\n";
     * // Get first robot by id (_id)
     * $robot = Robots::findFirst([
     * ['_id' => new \MongoId('45cbc4a0e4123f6920000002')]
     * ]);
     * echo 'The robot id is ', $robot->_id, "\n";
     * </code>
     *
     * @param array $parameters 
     * @return array 
     */
    public static function findFirst(array $parameters = null) {}

    /**
     * Allows to query a set of records that match the specified conditions
     * <code>
     * //How many robots are there?
     * $robots = Robots::find();
     * echo "There are ", count($robots), "\n";
     * //How many mechanical robots are there?
     * $robots = Robots::find(array(
     * array("type" => "mechanical")
     * ));
     * echo "There are ", count(robots), "\n";
     * //Get and print virtual robots ordered by name
     * $robots = Robots::findFirst(array(
     * array("type" => "virtual"),
     * "order" => array("name" => 1)
     * ));
     * foreach ($robots as $robot) {
     * echo $robot->name, "\n";
     * }
     * //Get first 100 virtual robots ordered by name
     * $robots = Robots::find(array(
     * array("type" => "virtual"),
     * "order" => array("name" => 1),
     * "limit" => 100
     * ));
     * foreach ($robots as $robot) {
     * echo $robot->name, "\n";
     * }
     * </code>
     *
     * @param array $parameters 
     * @return array 
     */
    public static function find(array $parameters = null) {}

    /**
     * Perform a count over a collection
     * <code>
     * echo 'There are ', Robots::count(), ' robots';
     * </code>
     *
     * @param array $parameters 
     * @return array 
     */
    public static function count(array $parameters = null) {}

    /**
     * Perform an aggregation using the Mongo aggregation framework
     *
     * @param array $parameters 
     * @return array 
     */
    public static function aggregate(array $parameters = null) {}

    /**
     * Allows to perform a summatory group for a column in the collection
     *
     * @param string $field 
     * @param mixed $conditions 
     * @param mixed $finalize 
     * @return array 
     */
    public static function summatory($field, $conditions = null, $finalize = null) {}

    /**
     * Deletes a model instance. Returning true on success or false otherwise.
     * <code>
     * $robot = Robots::findFirst();
     * $robot->delete();
     * foreach (Robots::find() as $robot) {
     * $robot->delete();
     * }
     * </code>
     *
     * @return bool 
     */
    public function delete() {}

    /**
     * Sets up a behavior in a collection
     *
     * @param mixed $behavior 
     */
    protected function addBehavior(\Phalcon\Mvc\Collection\BehaviorInterface $behavior) {}

    /**
     * Skips the current operation forcing a success state
     *
     * @param bool $skip 
     */
    public function skipOperation($skip) {}

    /**
     * Returns the instance as an array representation
     * <code>
     * print_r($robot->toArray());
     * </code>
     *
     * @return array 
     */
    public function toArray() {}

    /**
     * Serializes the object ignoring connections or protected properties
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

}
