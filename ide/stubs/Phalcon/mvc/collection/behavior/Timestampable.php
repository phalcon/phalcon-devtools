<?php

namespace Phalcon\Mvc\Collection\Behavior;

/**
 * Phalcon\Mvc\Collection\Behavior\Timestampable
 *
 * Allows to automatically update a model’s attribute saving the
 * datetime when a record is created or updated
 */
class Timestampable extends \Phalcon\Mvc\Collection\Behavior
{

    /**
     * Listens for notifications from the models manager
     *
     * @param string $type
     * @param \Phalcon\Mvc\CollectionInterface $model
     */
    public function notify($type, \Phalcon\Mvc\CollectionInterface $model) {}

}
