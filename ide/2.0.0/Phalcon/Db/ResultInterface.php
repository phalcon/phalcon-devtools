<?php 

namespace Phalcon\Db {

    /**
     * Lacks of documentation
     */
    interface ResultInterface
        {

        public function __construct($connection, $result, $sqlStatement=null, $bindParams=null, $bindTypes=null);


        public function execute();


        public function fetch();


        public function fetchArray();


        public function fetchAll();


        public function numRows();


        public function dataSeek($number);


        public function setFetchMode($fetchMode);


        public function getInternalResult();

    }
}
