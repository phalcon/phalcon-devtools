<?php

namespace Phalcon\Mvc\Collection\Behavior;

/**
 * Phalcon\Mvc\Collection\Behavior\SoftDelete
 *
 * Instead of permanently delete a record it marks the record as
 * deleted changing the value of a flag column
 */
class SoftDelete extends \Phalcon\Mvc\Collection\Behavior
{

    /**
     * Listens for notifications from the models manager
     *
     * @param string $type
     * @param \Phalcon\Mvc\CollectionInterface $model
     */
    public function notify($type, \Phalcon\Mvc\CollectionInterface $model) {}

}
