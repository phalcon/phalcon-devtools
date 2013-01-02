<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Criteria
	 *
	 * This class allows to build the array parameter required by Phalcon\Mvc\Model::find
	 * and Phalcon\Mvc\Model::findFirst, using an object-oriented interfase
	 */
	
	class Criteria {

		protected $_model;

		protected $_params;

		public function __construct(){ }


		/**
		 * Sets the DependencyInjector container
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the DependencyInjector container
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Set a model on which the query will be executed
		 *
		 * @param string $modelName
		 */
		public function setModelName($modelName){ }


		/**
		 * Returns an internal model name on which the criteria will be applied
		 *
		 * @return string
		 */
		public function getModelName(){ }


		/**
		 * Adds the bind parameter to the criteria
		 *
		 * @param string $bindParams
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function bind($bindParams){ }


		/**
		 * Adds the conditions parameter to the criteria
		 *
		 * @param string $conditions
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function where($conditions){ }


		/**
		 * Adds the conditions parameter to the criteria
		 *
		 * @param string $conditions
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function conditions($conditions){ }


		/**
		 * Adds the order-by parameter to the criteria
		 *
		 * @param string $orderColumns
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function order($orderColumns){ }


		/**
		 * Adds the limit parameter to the criteria
		 *
		 * @param string $orderColumns
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function limit($limit){ }


		/**
		 * Adds the "for_update" parameter to the criteria
		 *
		 * @param string $orderColumns
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function forUpdate($forUpdate){ }


		/**
		 * Adds the "shared_lock" parameter to the criteria
		 *
		 * @param string $orderColumns
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function sharedLock($sharedLock){ }


		/**
		 * Returns the conditions parameter in the criteria
		 *
		 * @return string
		 */
		public function getWhere(){ }


		/**
		 * Returns the conditions parameter in the criteria
		 *
		 * @return string
		 */
		public function getConditions(){ }


		/**
		 * Returns the limit parameter in the criteria
		 *
		 * @return string
		 */
		public function getLimit(){ }


		/**
		 * Returns the order parameter in the criteria
		 *
		 * @return string
		 */
		public function getOrder(){ }


		/**
		 * Returns all the parameters defined in the criteria
		 *
		 * @return string
		 */
		public function getParams(){ }


		/**
		 * Builds a \Phalcon\Mvc\Model\Criteria based on an input array like $_POST
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 * @param string $modelName
		 * @param array $data
		 */
		public static function fromInput($dependencyInjector, $modelName, $data){ }


		/**
		 * Executes a find using the parameters built with the criteria
		 *
		 * @return \Phalcon\Mvc\Model\Resultset
		 */
		public function execute(){ }

	}
}
