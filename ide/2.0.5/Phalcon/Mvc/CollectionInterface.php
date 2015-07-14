<?php

namespace Phalcon\Mvc;

use Phalcon\Mvc\Model\MessageInterface;


interface CollectionInterface
{

	/**
	 * Sets a value for the _id propery, creates a MongoId object if needed
	 * 
	 * @param mixed $id
	 *
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
	 * Returns a cloned collection
	 * 
	 * @param CollectionInterface $collection
	 * @param array $document
	 *
	 * @return CollectionInterface
	 */
	public static function cloneResult(CollectionInterface $collection, array $document);

	/**
	 * Fires an event, implicitly calls behaviors and listeners in the events manager are notified
	 * 
	 * @param string $eventName
	 *
	 * @return boolean
	 */
	public function fireEvent($eventName);

	/**
	 * Fires an event, implicitly listeners in the events manager are notified
	 * This method stops if one of the callbacks/listeners returns boolean false
	 * 
	 * @param string $eventName
	 *
	 * @return boolean
	 */
	public function fireEventCancel($eventName);

	/**
	 * Check whether validation process has generated any messages
	 *
	 * @return boolean
	 */
	public function validationHasFailed();

	/**
	 * Returns all the validation messages
	 *
	 * @return MessageInterface[]
	 */
	public function getMessages();

	/**
	 * Appends a customized message on the validation process
	 * 
	 * @param MessageInterface $message
	 */
	public function appendMessage(MessageInterface $message);

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
	 * 
	 * @return CollectionInterface
	 */
	public static function findById($id);

	/**
	 * Allows to query the first record that match the specified conditions
	 *
	 * @param array $parameters
	 * 
	 * @return array
	 */
	public static function findFirst(array $parameters=null);

	/**
	 * Allows to query a set of records that match the specified conditions
	 *
	 * @param array $parameters
	 * 
	 * @return  array
	 */
	public static function find(array $parameters=null);

	/**
	 * Perform a count over a collection
	 *
	 * @param array $parameters
	 * 
	 * @return array
	 */
	public static function count(array $parameters=null);

	/**
	 * Deletes a model instance. Returning true on success or false otherwise
	 *
	 * @return boolean
	 */
	public function delete();

}
