<?php 

namespace Phalcon\Mvc\Model\MetaData {    interface StrategyInterface
        {

        public function getMetaData($model, $dependencyInjector);


        public function getColumnMaps($model, $dependencyInjector);

    }
}
