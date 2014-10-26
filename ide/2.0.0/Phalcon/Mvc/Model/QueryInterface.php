<?php 

namespace Phalcon\Mvc\Model {

    /**
     * Lacks of documentation
     */
    interface QueryInterface
        {

        public function parse();


        public function cache($cacheOptions);


        public function getCacheOptions();


        public function setUniqueRow($uniqueRow);


        public function getUniqueRow();


        public function execute($bindParams=null, $bindTypes=null);

    }
}
