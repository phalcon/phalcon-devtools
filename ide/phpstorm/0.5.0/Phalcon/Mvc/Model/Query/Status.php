<?php 

namespace Phalcon\Mvc\Model\Query {

	/**
	 * Phalcon\Mvc\Model\Query\Status
	 *
	 * This class represents the status returned by a PHQL
	 * statement like INSERT, UPDATE or DELETE. It offers context
	 * information and the related messages produced by the
	 * model which finally executes the operations when it fails
	 */
	
	class Status {

		protected $_success;

		protected $_model;

		/**
		 * \Phalcon\Mvc\Model\Query\Status
		 *
		 * @param boolean $success
		 * @param \Phalcon\Mvc\Model $model
		 */
		public function __construct($success, $model){ }


		/**
		 * Returns the model which executed the action
		 *
		 * @return \Phalcon\Mvc\Model
		 */
		public function getModel(){ }


		/**
		 * Returns the messages produced by a operation failed
		 *
		 * @return \Phalcon\Mvc\Model\Message[]
		 */
		public function getMessages(){ }


		/**
		 * Allows to check if the executed operation was successfull
		 *
		 * @return boolean
		 */
		public function success(){ }

	}
}
