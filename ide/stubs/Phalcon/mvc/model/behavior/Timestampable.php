<?php

namespace Phalcon\Mvc\Model\Behavior;

/**
 * Phalcon\Mvc\Model\Behavior\Timestampable
 *
 * Allows to automatically update a model’s attribute saving the
 * datetime when a record is created or updated
 */
class Timestampable extends \Phalcon\Mvc\Model\Behavior
{

    /**
     * Listens for notifications from the models manager
     *
     * @param string $type
     * @param \Phalcon\Mvc\ModelInterface $model
     */
    public function notify($type, \Phalcon\Mvc\ModelInterface $model) {}

}
