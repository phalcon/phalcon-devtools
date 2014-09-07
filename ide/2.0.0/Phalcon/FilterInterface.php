<?php 

namespace Phalcon {

    /**
     * Lacks of documentation
     */
    interface FilterInterface
        {

        public function add($name, $handler);


        public function sanitize($value, $filters);


        public function getFilters();

    }
}
