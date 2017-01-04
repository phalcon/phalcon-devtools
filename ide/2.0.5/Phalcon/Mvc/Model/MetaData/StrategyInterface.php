<?php

namespace Phalcon\Mvc\Model\MetaData;

use Phalcon\Mvc\ModelInterface;
use Phalcon\DiInterface;


interface StrategyInterface
{

	/**
	 * The meta-data is obtained by reading the column descriptions from the database information schema
	 *
	 * @param ModelInterface $model
	 * @param DiInterface $dependencyInjector
	 * 
	 * @return array
	 */
	public function getMetaData(ModelInterface $model, DiInterface $dependencyInjector);

	/**
	 * Read the model's column map, this can't be inferred
	 *
	 * @param ModelInterface $model
	 * @param DiInterface $dependencyInjector
	 * 
	 * @return array
	 * @todo Not implemented
	 */
	public function getColumnMaps(ModelInterface $model, DiInterface $dependencyInjector);

}
