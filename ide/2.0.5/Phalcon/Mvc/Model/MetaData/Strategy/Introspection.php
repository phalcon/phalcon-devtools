<?php

namespace Phalcon\Mvc\Model\MetaData\Strategy;

use Phalcon\DiInterface;
use Phalcon\Db\Column;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Exception;
use Phalcon\Mvc\Model\MetaData;
use Phalcon\Mvc\Model\MetaData\StrategyInterface;


class Introspection implements StrategyInterface
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
		 * Check if the mapped table exists on the database</comment>
	 * 
	 * @param ModelInterface $model
	 * @param \Phalcon\DiInterface $dependencyInjector
		 *
	 * @return array
	 */
	public final function getColumnMaps(ModelInterface $model, \Phalcon\DiInterface $dependencyInjector) {}

}
