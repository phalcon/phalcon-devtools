<?php 

namespace Phalcon\Mvc\Model\MetaData\Strategy {    class Annotations
    {

        /**
         * The meta-data is obtained by reading the column descriptions from the database information schema
         *
         * @param \Phalcon\Mvc\ModelInterface model
         * @param \Phalcon\DiInterface dependencyInjector
         * @return array
         */
        public function getMetaData($model, $dependencyInjector)
        {
        }


        /**
         * Read the model's column map, this can't be inferred
         *
         * @param \Phalcon\Mvc\ModelInterface model
         * @param \Phalcon\DiInterface dependencyInjector
         * @return array
         * @todo Not implemented
         */
        public function getColumnMaps()
        {
        }

    }
}
