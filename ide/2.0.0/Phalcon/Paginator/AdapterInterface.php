<?php 

namespace Phalcon\Paginator {    interface AdapterInterface
        {

        public function setCurrentPage($page);


        public function getPaginate();

    }
}
