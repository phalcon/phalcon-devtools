<?php 

namespace Phalcon\Mvc\Model {

    /**
     * Lacks of documentation
     */
    interface TransactionInterface
        {

        public function __construct($dependencyInjector, $autoBegin=null, $service=null);


        public function setTransactionManager($manager);


        public function begin();


        public function commit();


        public function rollback($rollbackMessage=null, $rollbackRecord=null);


        public function getConnection();


        public function setIsNewTransaction($isNew);


        public function setRollbackOnAbort($rollbackOnAbort);


        public function isManaged();


        public function getMessages();


        public function isValid();


        public function setRollbackedRecord($record);

    }
}
