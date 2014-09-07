<?php 

namespace Phalcon\Mvc\Model {    interface ManagerInterface
        {

        public function initialize($model);


        public function isInitialized($modelName);


        public function getLastInitialized();


        public function load($modelName, $newInstance);


        public function addHasOne($model, $fields, $referencedModel, $referencedFields, $options=null);


        public function addBelongsTo($model, $fields, $referencedModel, $referencedFields, $options=null);


        public function addHasMany($model, $fields, $referencedModel, $referencedFields, $options=null);


        public function existsBelongsTo($modelName, $modelRelation);


        public function existsHasMany($modelName, $modelRelation);


        public function existsHasOne($modelName, $modelRelation);


        public function getBelongsToRecords($method, $modelName, $modelRelation, $record, $parameters=null);


        public function getHasManyRecords($method, $modelName, $modelRelation, $record, $parameters=null);


        public function getHasOneRecords($method, $modelName, $modelRelation, $record, $parameters=null);


        public function getBelongsTo($model);


        public function getHasMany($model);


        public function getHasOne($model);


        public function getHasOneAndHasMany($model);


        public function getRelations($modelName);


        public function getRelationsBetween($first, $second);


        public function createQuery($phql);


        public function executeQuery($phql, $placeholders=null);


        public function createBuilder($params=null);


        public function addBehavior($model, $behavior);


        public function notifyEvent($eventName, $model);


        public function missingMethod($model, $eventName, $data);


        public function getLastQuery();

    }
}
