<?php 

namespace Phalcon\Paginator {

    /**
     * Phalcon\Paginator\AdapterInterface initializer
     */
    interface AdapterInterface
        {

        /**
         * Set the current page number
         *
         * @param int $page
         */
        public function setCurrentPage($page);


        /**
         * Returns a slice of the resultset to show in the pagination
         *
         * @return stdClass
         */
        public function getPaginate();

    }
}
