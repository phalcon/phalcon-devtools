<?php 

namespace Phalcon\Paginator {

    /**
     * Lacks of documentation
     */
    interface AdapterInterface
        {

        public function __construct($config);


        public function setCurrentPage($page);


        public function getPaginate();

    }
}
