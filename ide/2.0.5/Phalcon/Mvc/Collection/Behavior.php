<?php

namespace Phalcon\Mvc\Collection;

use Phalcon\Mvc\CollectionInterface;


abstract class Behavior
{

	protected $_options;



	/**
	 * Phalcon\Mvc\Collection\Behavior
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Checks whether the behavior must take action on certain event
	 * 
	 * @param string $eventName
	 *
	 * @return boolean
	 */
	protected function mustTakeAction($eventName) {}

	/**
	 * Returns the behavior options related to an event
	 *
	 * @param string $eventName
	 * 
	 * @return mixed
	 */
	protected function getOptions($eventName=null) {}

	/**
	 * This method receives the notifications from the EventsManager
	 * 
	 * @param string $type
	 * @param CollectionInterface $model
	 *
	 * @return mixed
	 */
	public function notify($type, CollectionInterface $model) {}

	/**
	 * Acts as fallbacks when a missing method is called on the collection
	 * 
	 * @param CollectionInterface $model
	 * @param string $method
	 * @param $arguments
	 *
	 * @return mixed
	 */
	public function missingMethod(CollectionInterface $model, $method, $arguments=null) {}

}
