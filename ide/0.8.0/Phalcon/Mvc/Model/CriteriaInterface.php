<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\CriteriaInterface initializer
	 */
	
	interface CriteriaInterface {

		/**
		 * Set a model on which the query will be executed
		 *
		 * @param string $modelName
		 * @return \Phalcon\Mvc\Model\CriteriaInterface
		 */
		public function setModelName($modelName);


		/**
		 * Returns an internal model name on which the criteria will be applied
		 *
		 * @return string
		 */
		public function getModelName();


		/**
		 * Adds the bind parameter to the criteria
		 *
		 * @param string $bindParams
		 * @return \Phalcon\Mvc\Model\CriteriaInterface
		 */
		public function bind($bindParams);


		/**
		 * Adds the conditions parameter to the criteria
		 *
		 * @param string $conditions
		 * @return \Phalcon\Mvc\Model\CriteriaInterface
		 */
		public function where($conditions);


		/**
		 * Adds the conditions parameter to the criteria
		 *
		 * @param string $conditions
		 * @return \Phalcon\Mvc\Model\CriteriaInterface
		 */
		public function conditions($conditions);


		/**
		 * Adds the order-by parameter to the criteria
		 *
		 * @param string $orderColumns
		 * @return \Phalcon\Mvc\Model\CriteriaInterface
		 */
		public function order($orderColumns);


		/**
		 * Adds the limit parameter to the criteria
		 *
		 * @param int $limit
		 * @param int $offset
		 * @return \Phalcon\Mvc\Model\CriteriaInterface
		 */
		public function limit($limit, $offset=null);


		/**
		 * Adds the "for_update" parameter to the criteria
		 *
		 * @param boolean $forUpdate
		 * @return \Phalcon\Mvc\Model\CriteriaInterface
		 */
		public function forUpdate($forUpdate=null);


		/**
		 * Adds the "shared_lock" parameter to the criteria
		 *
		 * @param boolean $sharedLock
		 * @return \Phalcon\Mvc\Model\Criteria
		 */
		public function sharedLock($sharedLock=null);


		/**
		 * Returns the conditions parameter in the criteria
		 *
		 * @return string
		 */
		public function getWhere();


		/**
		 * Returns the conditions parameter in the criteria
		 *
		 * @return string
		 */
		public function getConditions();


		/**
		 * Returns the limit parameter in the criteria
		 *
		 * @return string
		 */
		public function getLimit();


		/**
		 * Returns the order parameter in the criteria
		 *
		 * @return string
		 */
		public function getOrder();


		/**
		 * Returns all the parameters defined in the criteria
		 *
		 * @return string
		 */
		public function getParams();


		/**
		 * Builds a \Phalcon\Mvc\Model\Criteria based on an input array like $_POST
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @param string $modelName
		 * @param array $data
		 */
		public function fromInput($dependencyInjector, $modelName, $data);


		/**
		 * Executes a find using the parameters built with the criteria
		 *
		 * @return \Phalcon\Mvc\Model\ResultsetInterface
		 */
		public function execute();

	}
}
