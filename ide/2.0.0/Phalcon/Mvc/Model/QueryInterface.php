<?php 

namespace Phalcon\Mvc\Model {    interface QueryInterface
        {

        public function parse();


        public function execute($bindParams=null, $bindTypes=null);

    }
}
