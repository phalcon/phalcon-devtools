<?php

namespace Phalcon\Mvc\Model\Behavior;

class SoftDelete extends \Phalcon\Mvc\Model\Behavior implements \Phalcon\Mvc\Model\BehaviorInterface
{

    /**
     * Listens for notifications from the models manager
     *
     * @param string $type 
     * @param \Phalcon\Mvc\ModelInterface $model 
     */
	public function notify($type, \Phalcon\Mvc\ModelInterface $model) {}

}
