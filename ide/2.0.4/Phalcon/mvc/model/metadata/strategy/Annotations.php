<?php

namespace Phalcon\Mvc\Model\MetaData\Strategy;


class Annotations implements \Phalcon\Mvc\Model\MetaData\StrategyInterface
{

    /**
     * The meta-data is obtained by reading the column descriptions from the database information schema
     *
     * @param mixed $model 
     * @param mixed $dependencyInjector 
     * @return array 
     */
    public final function getMetaData(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Read the model's column map, this can't be inferred
     *
     * @param mixed $model 
     * @param mixed $dependencyInjector 
     * @return array 
     */
    public final function getColumnMaps(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector) {}

}
