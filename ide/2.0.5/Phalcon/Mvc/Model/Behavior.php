<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\ModelInterface;


abstract class Behavior
{

	protected $_options;



	/**
	 * Phalcon\Mvc\Model\Behavior
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
	 * @param ModelInterface $model
	 *
	 * @return mixed
	 */
	public function notify($type, ModelInterface $model) {}

	/**
	 * Acts as fallbacks when a missing method is called on the model
	 * 
	 * @param ModelInterface $model
	 * @param string $method
	 * @param array $arguments
	 *
	 *
	 * @return mixed
	 */
	public function missingMethod(ModelInterface $model, $method, $arguments=null) {}

}
