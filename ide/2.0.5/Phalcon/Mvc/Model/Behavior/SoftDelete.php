<?php

namespace Phalcon\Mvc\Model\Behavior;

use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Behavior;
use Phalcon\Mvc\Model\BehaviorInterface;
use Phalcon\Mvc\Model\Exception;


class SoftDelete extends Behavior implements BehaviorInterface
{

	/**
	 * Listens for notifications from the models manager
	 * 
	 * @param string $type
	 * @param ModelInterface $model
	 *
	 * @return mixed
	 */
	public function notify($type, ModelInterface $model) {}

}
