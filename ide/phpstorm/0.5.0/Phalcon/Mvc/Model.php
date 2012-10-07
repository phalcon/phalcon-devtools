<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Model
	 *
	 * <p>Phalcon\Mvc\Model connects business objects and database tables to create
	 * a persistable domain model where logic and data are presented in one wrapping.
	 * It‘s an implementation of the object-relational mapping (ORM).</p>
	 *
	 * <p>A model represents the information (data) of the application and the rules to manipulate that data.
	 * Models are primarily used for managing the rules of interaction with a corresponding database table.
	 * In most cases, each table in your database will correspond to one model in your application.
	 * The bulk of your application’s business logic will be concentrated in the models.</p>
	 *
	 * <p>Phalcon\Mvc\Model is the first ORM written in C-language for PHP, giving to developers high performance
	 * when interacting with databases while is also easy to use.</p>
	 *
	 * <code>
	 *
	 * $robot = new Robots();
	 * $robot->type = 'mechanical'
	 * $robot->name = 'Astro Boy';
	 * $robot->year = 1952;
	 * if ($robot->save() == false) {
	 *  echo "Umh, We can store robots: ";
	 *  foreach ($robot->getMessages() as $message) {
	 *    echo $message;
	 *  }
	 * } else {
	 *  echo "Great, a new robot was saved successfully!";
	 * }
	 * </code>
	 *
	 */
	
	abstract class Model {

		const OP_CREATE = 1;

		const OP_UPDATE = 2;

		const OP_DELETE = 3;

		protected $_dependencyInjector;

		protected $_eventsManager;

		protected $_uniqueKey;

		protected $_schema;

		protected $_source;

		protected $_errorMessages;

		protected $_operationMade;

		protected $_forceExists;

		protected $_connection;

		protected $_connectionService;

		protected static $_disableEvents;

		/**
		 * \Phalcon\Mvc\Model constructor
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 * @param string $managerService
		 * @param string $dbService
		 */
		final public function __construct($dependencyInjector, $managerService, $dbService){ }


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
		 * Creates a SQL statement which returns many rows
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 * @param \Phalcon\Mvc\Model $model
		 * @param \Phalcon\Db $connection
		 * @param array $params
		 * @return array
		 */
		protected static function _createSQLSelect(){ }


		/**
		 * Gets a resulset from the cache or creates one
		 *
		 * @param string $modelName
		 * @param \Phalcon\Db $connection
		 * @param array $params
		 * @param boolean $unique
		 */
		protected static function _getOrCreateResultset(){ }


		/**
		 * Sets a transaction related to the Model instance
		 *
		 *<code>
		 *try {
		 *
		 *  $transactionManager = new \Phalcon\Mvc\Model\Transaction\Manager();
		 *
		 *  $transaction = $transactionManager->get();
		 *
		 *  $robot = new Robots();
		 *  $robot->setTransaction($transaction);
		 *  $robot->name = 'WALL·E';
		 *  $robot->created_at = date('Y-m-d');
		 *  if($robot->save()==false){
		 *    $transaction->rollback("Can't save robot");
		 *  }
		 *
		 *  $robotPart = new RobotParts();
		 *  $robotPart->setTransaction($transaction);
		 *  $robotPart->type = 'head';
		 *  if ($robotPart->save() == false) {
		 *    $transaction->rollback("Can't save robot part");
		 *  }
		 *
		 *  $transaction->commit();
		 *
		 *}
		 *catch(Phalcon\Mvc\Model\Transaction\Failed $e){
		 *  echo 'Failed, reason: ', $e->getMessage();
		 *}
		 *
		 *</code>
		 *
		 * @param \Phalcon\Mvc\Model\Transaction $transaction
		 * @return \Phalcon\Mvc\Model
		 */
		public function setTransaction($transaction){ }


		/**
		 * Sets table name which model should be mapped
		 *
		 * @param string $source
		 * @return \Phalcon\Mvc\Model
		 */
		protected function setSource(){ }


		/**
		 * Returns table name mapped in the model
		 *
		 * @return string
		 */
		public function getSource(){ }


		/**
		 * Sets schema name where table mapped is located
		 *
		 * @param string $schema
		 * @return \Phalcon\Mvc\Model
		 */
		protected function setSchema(){ }


		/**
		 * Returns schema name where table mapped is located
		 *
		 * @return string
		 */
		public function getSchema(){ }


		/**
		 * Sets DependencyInjection connection service
		 *
		 * @param string $connectionService
		 */
		public function setConnectionService($connectionService){ }


		/**
		 * Returns DependencyInjection connection service
		 *
		 * @return $connectionService
		 */
		public function getConnectionService(){ }


		/**
		 *
		 */
		public function setForceExists($forceExists){ }


		/**
		 * Gets internal database connection
		 *
		 * @return \Phalcon\Db
		 */
		public function getConnection(){ }


		/**
		 * Assigns values to a model from an array returning a new model
		 *
		 *<code>
		 *$robot = \Phalcon\Mvc\Model::dumpResult(new Robots(), array(
		 *  'type' => 'mechanical',
		 *  'name' => 'Astro Boy',
		 *  'year' => 1952
		 *));
		 *</code>
		 *
		 * @param array $result
		 * @param \Phalcon\Mvc\Model $base
		 * @return \Phalcon\Mvc\Model $result
		 */
		public static function dumpResult($base, $result){ }


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
		 * $robots = Robots::find("type='mechanical'");
		 * echo "There are ", count($robots);
		 *
		 * //Get and print virtual robots ordered by name
		  * $robots = Robots::find(array("type='virtual'", "order" => "name"));
		 * foreach ($robots as $robot) {
		 *	   echo $robot->name, "\n";
		 * }
		 *
		  * //Get first 100 virtual robots ordered by name
		  * $robots = Robots::find(array("type='virtual'", "order" => "name", "limit" => 100));
		 * foreach ($robots as $robot) {
		 *	   echo $robot->name, "\n";
		 * }
		 * </code>
		 *
		 * @param 	array $parameters
		 * @return  \Phalcon\Mvc\Model\Resultset
		 */
		public static function find($parameters){ }


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
		 * $robot = Robots::findFirst("type='mechanical'");
		 * echo "The first mechanical robot name is ", $robot->name;
		 *
		 * //Get first virtual robot ordered by name
		  * $robot = Robots::findFirst(array("type='virtual'", "order" => "name"));
		 * echo "The first virtual robot name is ", $robot->name;
		 *
		 * </code>
		 *
		 * @param array $parameters
		 * @return \Phalcon\Mvc\Model
		 */
		public static function findFirst($parameters){ }


		/**
		 * Create a criteria for a especific model
		 *
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public static function query($dependencyInjector){ }


		/**
		 * Checks if the current record already exists or not
		 *
		 * @param \Phalcon\Mvc\Model\Metadata $metaData
		 * @param \Phalcon\Db $connection
		 * @return boolean
		 */
		protected function _exists(){ }


		/**
		 * Generate a SQL SELECT statement for an aggregate
		 *
		 * @param string $function
		 * @param string $alias
		 * @param array $parameters
		 * @return \Phalcon\Mvc\Model\Resultset
		 */
		protected static function _prepareGroupResult(){ }


		/**
		 * Generate a resulset from an SQL select with aggregations
		 *
		 * @param \Phalcon\Db $connection
		 * @param array $params
		 * @param string $sqlSelect
		 * @param string $alias
		 * @return array|Phalcon\Mvc\Model\Resultset
		 */
		protected static function _getGroupResult(){ }


		/**
		 * Allows to count how many records match the specified conditions
		 *
		 * <code>
		 *
		 * //How many robots are there?
		 * $number = Robots::count();
		 * echo "There are ", $number;
		 *
		 * //How many mechanical robots are there?
		 * $number = Robots::count("type='mechanical'");
		 * echo "There are ", $number, " mechanical robots";
		 *
		 * </code>
		 *
		 * @param array $parameters
		 * @return int
		 */
		public static function count($parameters){ }


		/**
		 * Allows to a calculate a summatory on a column that match the specified conditions
		 *
		 * <code>
		 *
		 * //How much are all robots?
		 * $sum = Robots::sum(array('column' => 'price'));
		 * echo "The total price of robots is ", $sum;
		 *
		 * //How much are mechanical robots?
		 * $sum = Robots::sum(array("type='mechanical'", 'column' => 'price'));
		 * echo "The total price of mechanical robots is  ", $sum;
		 *
		 * </code>
		 *
		 * @param array $parameters
		 * @return double
		 */
		public static function sum($parameters){ }


		/**
		 * Allows to get the maximum value of a column that match the specified conditions
		 *
		 * <code>
		 *
		 * //What is the maximum robot id?
		 * $id = Robots::maximum(array('column' => 'id'));
		 * echo "The maximum robot id is: ", $id;
		 *
		 * //What is the maximum id of mechanical robots?
		 * $sum = Robots::maximum(array("type='mechanical'", 'column' => 'id'));
		 * echo "The maximum robot id of mechanical robots is ", $id;
		 *
		 * </code>
		 *
		 * @param array $parameters
		 * @return mixed
		 */
		public static function maximum($parameters){ }


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
		 * @return mixed
		 */
		public static function minimum($parameters){ }


		/**
		 * Allows to calculate the average value on a column matching the specified conditions
		 *
		 * <code>
		 *
		 * //What's the average price of robots?
		 * $average = Robots::average(array('column' => 'price'));
		 * echo "The average price is ", $average;
		 *
		 * //What's the average price of mechanical robots?
		 * $average = Robots::average(array("type='mechanical'", 'column' => 'price'));
		 * echo "The average price of mechanical robots is ", $average;
		 *
		 * </code>
		 *
		 * @param array $parameters
		 * @return double
		 */
		public static function average($parameters){ }


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
		 *     if (this->name == 'Peter') {
		 *        $message = new Message("Sorry, but a robot cannot be named Peter");
		 *        $this->appendMessage($message);
		 *     }
		 *   }
		 * }
		 * </code>
		 *
		 * @param \Phalcon\Mvc\Model\Message $message
		 */
		public function appendMessage($message){ }


		/**
		 * Executes validators on every validation call
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
		 * @param object $validator
		 * @param array $options
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
		 * Returns all the validation messages
		 *
		 * <code>
		 *$robot = new Robots();
		 *$robot->type = 'mechanical';
		 *$robot->name = 'Astro Boy';
		 *$robot->year = 1952;
		 *if ($robot->save() == false) {
		 *  echo "Umh, We can't store robots right now ";
		 *  foreach ($robot->getMessages() as $message) {
		 *    echo $message;
		 *  }
		 *} else {
		 *  echo "Great, a new robot was saved successfully!";
		 *}
		 * </code>
		 *
		 * @return \Phalcon\Mvc\Model\Message[]
		 */
		public function getMessages(){ }


		/**
		 * Reads "belongs to" relations and check the virtual foreign keys when inserting or updating records
		 *
		 * @return boolean
		 */
		protected function _checkForeignKeys(){ }


		/**
		 * Reads both "hasMany" and "hasOne" relations and check the virtual foreign keys when deleting records
		 *
		 * @return boolean
		 */
		protected function _checkForeignKeysReverse(){ }


		/**
		 * Executes internal hooks before save a record
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 * @param \Phalcon\Mvc\Model\Metadata $metaData
		 * @param boolean $disableEvents
		 * @param boolean $exists
		 * @param string $identityField
		 * @return boolean
		 */
		protected function _preSave(){ }


		/**
		 * Executes internal events after save a record
		 *
		 * @param boolean $disableEvents
		 * @param boolean $success
		 * @param boolean $exists
		 * @return boolean
		 */
		protected function _postSave(){ }


		/**
		 * Sends a pre-build INSERT SQL statement to the relational database system
		 *
		 * @param \Phalcon\Mvc\Model\Metadata $metaData
		 * @param \Phalcon\Db $connection
		 * @param string $table
		 * @return boolean
		 */
		protected function _doLowInsert(){ }


		/**
		 * Sends a pre-build UPDATE SQL statement to the relational database system
		 *
		 * @param \Phalcon\Mvc\Model\Metadata $metaData
		 * @param \Phalcon\Db $connection
		 * @param string $table
		 * @return boolean
		 */
		protected function _doLowUpdate(){ }


		/**
		 * Inserts or updates a model instance. Returning true on success or false otherwise.
		 *
		 * <code>
		 * //Creating a new robot
		 *$robot = new Robots();
		 *$robot->type = 'mechanical'
		 *$robot->name = 'Astro Boy';
		 *$robot->year = 1952;
		 *$robot->save();
		 *
		 * //Updating a robot name
		 *$robot = Robots::findFirst("id=100");
		 *$robot->name = "Biomass";
		 *$robot->save();
		 * </code>
		 *
		 * @return boolean
		 */
		public function save(){ }


		public function create(){ }


		public function update(){ }


		/**
		 * Deletes a model instance. Returning true on success or false otherwise.
		 *
		 * <code>
		 *$robot = Robots::findFirst("id=100");
		 *$robot->delete();
		 *
		 *foreach(Robots::find("type = 'mechanical'") as $robot){
		 *   $robot->delete();
		 *}
		 * </code>
		 *
		 * @return boolean
		 */
		public function delete(){ }


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
		 * Setup a 1-1 relation between two models
		 *
		 *<code>
		 *
		 *class Robots extends \Phalcon\Mvc\Model
		 *{
		 *
		 *   public function initialize(){
		 *       $this->hasOne('id', 'RobotsDescription', 'robots_id');
		 *   }
		 *
		 *}
		 *</code>
		 *
		 * @param mixed $fields
		 * @param string $referenceModel
		 * @param mixed $referencedFields
		 * @param   array $options
		 */
		protected function hasOne(){ }


		/**
		 * Setup a relation reverse 1-1  between two models
		 *
		 *<code>
		 *
		 *class RobotsParts extends \Phalcon\Mvc\Model
		 *{
		 *
		 *   public function initialize(){
		 *       $this->belongsTo('robots_id', 'Robots', 'id');
		 *   }
		 *
		 *}
		 *</code>
		 *
		 * @param mixed $fields
		 * @param string $referenceModel
		 * @param mixed $referencedFields
		 * @param   array $options
		 */
		protected function belongsTo(){ }


		/**
		 * Setup a relation 1-n between two models
		 *
		 *<code>
		 *
		 *class Robots extends \Phalcon\Mvc\Model
		 *{
		 *
		 *   public function initialize()
		 *   {
		 *       $this->hasMany('id', 'RobotsParts', 'robots_id');
		 *   }
		 *
		 *}
		 *</code>
		 *
		 * @param mixed $fields
		 * @param string $referenceModel
		 * @param mixed $referencedFields
		 * @param   array $options
		 */
		protected function hasMany(){ }


		protected function __getRelatedRecords(){ }


		/**
		 * Handles methods when a method does not exist
		 *
		 * @param string $method
		 * @param array $arguments
		 * @return mixed
		 */
		public function __call($method, $arguments){ }


		public function serialize(){ }


		public function unserialize($data){ }

	}
}
