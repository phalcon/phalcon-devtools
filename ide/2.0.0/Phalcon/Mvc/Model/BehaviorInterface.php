<?php 

namespace Phalcon\Mvc\Model {

    /**
     * Lacks of documentation
     */
    interface BehaviorInterface
        {

        public function __construct($options=null);


        public function notify($type, $model);


        public function missingMethod($model, $method, $arguments=null);

    }
}
