<?php

namespace Phalcon\Mvc\Model\MetaData\Strategy;

use Phalcon\DiInterface;
use Phalcon\Db\Column;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\MetaData\StrategyInterface;
use Phalcon\Mvc\Model\Exception;


class Annotations implements StrategyInterface
{

	/**
	 * The meta-data is obtained by reading the column descriptions from the database information schema
	 * 
	 * @param ModelInterface $model
	 * @param DiInterface $dependencyInjector
	 *
	 * @return array
	 */
	public final function getMetaData(ModelInterface $model, DiInterface $dependencyInjector) {}

	/**
		 * Get the properties defined in
	 * 
	 * @param ModelInterface $model
	 * @param DiInterface $dependencyInjector
		 *
	 * @return array
	 */
	public final function getColumnMaps(ModelInterface $model, DiInterface $dependencyInjector) {}

}
