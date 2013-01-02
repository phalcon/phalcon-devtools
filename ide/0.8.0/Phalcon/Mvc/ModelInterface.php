<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\ModelInterface initializer
	 */
	
	interface ModelInterface {

		/**
		 * \Phalcon\Mvc\Model constructor
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @param \Phalcon\Mvc\Model\ManagerInterface $modelsManager
		 */
		public function __construct($dependencyInjector=null, $modelsManager=null);


		/**
		 * Sets a transaction related to the Model instance
		 *
		 * @param \Phalcon\Mvc\Model\TransactionInterface $transaction
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function setTransaction($transaction);


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
		 * Sets the DependencyInjection connection service
		 *
		 * @param string $connectionService
		 */
		public function setConnectionService($connectionService);


		/**
		 * Returns DependencyInjection connection service
		 *
		 * @return string
		 */
		public function getConnectionService();


		/**
		 * Gets internal database connection
		 *
		 * @return \Phalcon\Db\AdapterInterface
		 */
		public function getConnection();


		/**
		 * Assigns values to a model from an array returning a new model
		 *
		 * @param array $result
		 * @param \Phalcon\Mvc\ModelInterface $base
		 * @return \Phalcon\Mvc\ModelInterface $result
		 */
		public function dumpResult($base, $result);


		/**
		 * Allows to query a set of records that match the specified conditions
		 *
		 * @param 	array $parameters
		 * @return  \Phalcon\Mvc\Model\ResultsetInterface
		 */
		public function find($parameters=null);


		/**
		 * Allows to query the first record that match the specified conditions
		 *
		 * @param array $parameters
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function findFirst($parameters=null);


		/**
		 * Create a criteria for a especific model
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @return \Phalcon\Mvc\Model\CriteriaInterface
		 */
		public function query($dependencyInjector=null);


		/**
		 * Allows to count how many records match the specified conditions
		 *
		 * @param array $parameters
		 * @return int
		 */
		public function count($parameters=null);


		/**
		 * Allows to calculate a summatory on a column that match the specified conditions
		 *
		 * @param array $parameters
		 * @return double
		 */
		public function sum($parameters=null);


		/**
		 * Allows to get the maximum value of a column that match the specified conditions
		 *
		 * @param array $parameters
		 * @return mixed
		 */
		public function maximum($parameters=null);


		/**
		 * Allows to get the minimum value of a column that match the specified conditions
		 *
		 * @param array $parameters
		 * @return mixed
		 */
		public function minimum($parameters=null);


		/**
		 * Allows to calculate the average value on a column matching the specified conditions
		 *
		 * @param array $parameters
		 * @return double
		 */
		public function average($parameters=null);


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
		 * @param \Phalcon\Mvc\Model\MessageInterface $message
		 */
		public function appendMessage($message);


		/**
		 * Check whether validation process has generated any messages
		 *
		 * @return boolean
		 */
		public function validationHasFailed();


		/**
		 * Returns all the validation messages
		 *
		 * @return \Phalcon\Mvc\Model\MessageInterface[]
		 */
		public function getMessages();


		/**
		 * Inserts or updates a model instance. Returning true on success or false otherwise.
		 *
		 * @param  array $data
		 * @return boolean
		 */
		public function save($data=null);


		/**
		 * Inserts a model instance. If the instance already exists in the persistance it will throw an exception
		 * Returning true on success or false otherwise.
		 *
		 * @param  array $data
		 * @return boolean
		 */
		public function create($data=null);


		/**
		 * Updates a model instance. If the instance doesn't exist in the persistance it will throw an exception
		 * Returning true on success or false otherwise.
		 *
		 * @param  array $data
		 * @return boolean
		 */
		public function update($data=null);


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
		 * Reads an attribute value by its name
		 *
		 * @param string $attribute
		 * @return mixed
		 */
		public function readAttribute($attribute);


		/**
		 * Writes an attribute value by its name
		 *
		 * @param string $attribute
		 * @param mixed $value
		 */
		public function writeAttribute($attribute, $value);


		/**
		 * Returns related records based on defined relations
		 *
		 * @param string $modelName
		 * @param array $arguments
		 * @return \Phalcon\Mvc\Model\ResultsetInterface
		 */
		public function getRelated($modelName, $arguments=null);

	}
}
