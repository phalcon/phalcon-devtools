<?php 

namespace Phalcon\Mvc\Model\MetaData\Strategy {

	class Annotations implements \Phalcon\Mvc\Model\MetaData\StrategyInterface {

		/**
		 * The meta-data is obtained by reading the column descriptions from the database information schema
		 *
		 * @param \Phalcon\Mvc\ModelInterface model
		 * @param \Phalcon\DiInterface dependencyInjector
		 * @return array
		 */
		final public function getMetaData(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector){ }


		/**
		 * Read the model's column map, this can't be inferred
		 *
		 * @param \Phalcon\Mvc\ModelInterface model
		 * @param \Phalcon\DiInterface dependencyInjector
		 * @return array
		 */
		final public function getColumnMaps(\Phalcon\Mvc\ModelInterface $model, \Phalcon\DiInterface $dependencyInjector){ }

	}
}
