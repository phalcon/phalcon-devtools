<?php 

namespace Phalcon\Mvc\Model\MetaData\Strategy {

	/**
	 * Phalcon\Mvc\Model\MetaData\Strategy\Annotations
	 *
	 * Queries the table meta-data in order to instrospect the model's metadata
	 */
	
	class Annotations {

		/**
		 * The meta-data is obtained by reading the column descriptions from the database information schema
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @return array
		 */
		public function getMetaData($model, $dependencyInjector){ }


		/**
		 * Read the model's column map, this can't be infered
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @return array
		 */
		public function getColumnMaps(){ }

	}
}
