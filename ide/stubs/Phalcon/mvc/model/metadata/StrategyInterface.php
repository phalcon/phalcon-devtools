<?php

namespace Phalcon\Mvc\Model\MetaData;


interface StrategyInterface
{

    /**
     * The meta-data is obtained by reading the column descriptions from the database information schema
     *
     * @param \Phalcon\Mvc\ModelInterface $model
     * @param \Phalcon\DiInterface $dependencyInjector
     * @return array
     */
    public function getMetaData(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector);

    /**
     * Read the model's column map, this can't be inferred
     *
     * @todo Not implemented
     * @param \Phalcon\Mvc\ModelInterface $model
     * @param \Phalcon\DiInterface $dependencyInjector
     * @return array
     */
    public function getColumnMaps(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector);

}
