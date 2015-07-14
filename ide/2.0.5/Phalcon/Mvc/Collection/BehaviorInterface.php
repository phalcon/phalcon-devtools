<?php

namespace Phalcon\Mvc\Collection;

use Phalcon\Mvc\CollectionInterface;


interface BehaviorInterface
{

	/**
	 * Phalcon\Mvc\Collection\Behavior
	 * 
	 * @param array $options
	 *
	 */
	public function __construct($options=null);

	/**
	 * This method receives the notifications from the EventsManager
	 * 
	 * @param string $type
	 * @param CollectionInterface $collection
	 */
	public function notify($type, CollectionInterface $collection);

	/**
	 * Calls a method when it's missing in the collection
	 * 
	 * @param CollectionInterface $collection
	 * @param $arguments
	 */
	public function missingMethod(CollectionInterface $collection, $arguments=null);

}
