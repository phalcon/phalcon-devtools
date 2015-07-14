<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\ModelInterface;


interface BehaviorInterface
{

	/**
	 * Phalcon\Mvc\Model\Behavior
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null);

	/**
	 * This method receives the notifications from the EventsManager
	 * 
	 * @param string $type
	 * @param ModelInterface $model
	 */
	public function notify($type, ModelInterface $model);

	/**
	 * Calls a method when it's missing in the model
	 * 
	 * @param ModelInterface $model
	 * @param array $arguments
	 * @param string $method
	 *
	 */
	public function missingMethod(ModelInterface $model, $arguments=null);

}
