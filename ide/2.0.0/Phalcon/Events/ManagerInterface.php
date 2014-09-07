<?php 

namespace Phalcon\Events {

    /**
     * Lacks of documentation
     */
    interface ManagerInterface
        {

        public function attach($eventType, $handler);


        public function detachAll($type=null);


        public function fire($eventType, $source, $data=null);


        public function getListeners($type);

    }
}
