<?php

namespace Phalcon\Mvc\Collection\Behavior;

use Phalcon\Mvc\CollectionInterface;
use Phalcon\Mvc\Collection\Behavior;
use Phalcon\Mvc\Collection\BehaviorInterface;
use Phalcon\Mvc\Collection\Exception;


class SoftDelete extends Behavior implements BehaviorInterface
{

	/**
	 * Listens for notifications from the models manager
	 * 
	 * @param string $type
	 * @param CollectionInterface $model
	 *
	 * @return mixed
	 */
	public function notify($type, CollectionInterface $model) {}

}
