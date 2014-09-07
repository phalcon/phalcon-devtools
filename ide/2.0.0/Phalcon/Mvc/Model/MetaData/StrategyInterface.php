<?php 

namespace Phalcon\Mvc\Model\MetaData {

    /**
     * Lacks of documentation
     */
    interface StrategyInterface
        {

        public function getMetaData($model, $dependencyInjector);


        public function getColumnMaps($model, $dependencyInjector);

    }
}
