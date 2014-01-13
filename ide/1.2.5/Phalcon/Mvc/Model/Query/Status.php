<?php 

namespace Phalcon\Mvc\Model\Query {

	/**
	 * Phalcon\Mvc\Model\Query\Status
	 *
	 * This class represents the status returned by a PHQL
	 * statement like INSERT, UPDATE or DELETE. It offers context
	 * information and the related messages produced by the
	 * model which finally executes the operations when it fails
	 *
	 *<code>
	 *$phql = "UPDATE Robots SET name = :name:, type = :type:, year = :year: WHERE id = :id:";
	 *$status = $app->modelsManager->executeQuery($phql, array(
	 *   'id' => 100,
	 *   'name' => 'Astroy Boy',
	 *   'type' => 'mechanical',
	 *   'year' => 1959
	 *));
	 *
	 * //Check if the update was successful
	 * if ($status->success() == true) {
	 *   echo 'OK';
	 * }
	 *</code>
	 */
	
	class Status implements \Phalcon\Mvc\Model\Query\StatusInterface {

		protected $_success;

		protected $_model;

		/**
		 * \Phalcon\Mvc\Model\Query\Status
		 *
		 * @param boolean $success
		 * @param \Phalcon\Mvc\ModelInterface $model
		 */
		public function __construct($success, $model){ }


		/**
		 * Returns the model that executed the action
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getModel(){ }


		/**
		 * Returns the messages produced by a failed operation
		 *
		 * @return \Phalcon\Mvc\Model\MessageInterface[]
		 */
		public function getMessages(){ }


		/**
		 * Allows to check if the executed operation was successful
		 *
		 * @return boolean
		 */
		public function success(){ }

	}
}
