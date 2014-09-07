<?php 

namespace Phalcon\Mvc {    interface ModelInterface
        {

        public function setTransaction($transaction);


        public function getSource();


        public function getSchema();


        public function setConnectionService($connectionService);


        public function setWriteConnectionService($connectionService);


        public function setReadConnectionService($connectionService);


        public function getReadConnectionService();


        public function getWriteConnectionService();


        public function getReadConnection();


        public function getWriteConnection();


        public function assign($data, $columnMap=null);


        public static function cloneResultMap($base, $data, $columnMap, $dirtyState=null, $keepSnapshots=null);


        public static function cloneResult($base, $data, $dirtyState=null);


        public static function cloneResultMapHydrate($data, $columnMap, $hydrationMode);


        public static function find($parameters=null);


        public static function findFirst($parameters=null);


        public static function query($dependencyInjector=null);


        public static function count($parameters=null);


        public static function sum($parameters=null);


        public static function maximum($parameters=null);


        public static function minimum($parameters=null);


        public static function average($parameters=null);


        public function fireEvent($eventName);


        public function fireEventCancel($eventName);


        public function appendMessage($message);


        public function validationHasFailed();


        public function getMessages($filter=null);


        public function save($data=null, $whiteList=null);


        public function create($data=null, $whiteList=null);


        public function update($data=null, $whiteList=null);


        public function delete();


        public function getOperationMade();


        public function refresh();


        public function readAttribute($attribute);


        public function writeAttribute($attribute, $value);


        public function getRelated($alias, $arguments=null);


        public function reset();

    }
}
