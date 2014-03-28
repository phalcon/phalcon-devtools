<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\Transaction
	 *
	 * Transactions are protective blocks where SQL statements are only permanent if they can
	 * all succeed as one atomic action. Phalcon\Transaction is intended to be used with Phalcon_Model_Base.
	 * Phalcon Transactions should be created using Phalcon\Transaction\Manager.
	 *
	 *<code>
	 *try {
	 *
	 *  $manager = new Phalcon\Mvc\Model\Transaction\Manager();
	 *
	 *  $transaction = $manager->get();
	 *
	 *  $robot = new Robots();
	 *  $robot->setTransaction($transaction);
	 *  $robot->name = 'WALL·E';
	 *  $robot->created_at = date('Y-m-d');
	 *  if ($robot->save() == false) {
	 *    $transaction->rollback("Can't save robot");
	 *  }
	 *
	 *  $robotPart = new RobotParts();
	 *  $robotPart->setTransaction($transaction);
	 *  $robotPart->type = 'head';
	 *  if ($robotPart->save() == false) {
	 *    $transaction->rollback("Can't save robot part");
	 *  }
	 *
	 *  $transaction->commit();
	 *
	 *} catch(Phalcon\Mvc\Model\Transaction\Failed $e) {
	 *  echo 'Failed, reason: ', $e->getMessage();
	 *}
	 *
	 *</code>
	 */
	
	class Transaction implements \Phalcon\Mvc\Model\TransactionInterface {

		protected $_connection;

		protected $_activeTransaction;

		protected $_isNewTransaction;

		protected $_rollbackOnAbort;

		protected $_manager;

		protected $_messages;

		protected $_rollbackRecord;

		/**
		 * \Phalcon\Mvc\Model\Transaction constructor
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 * @param boolean $autoBegin
		 * @param string $service
		 */
		public function __construct($dependencyInjector, $autoBegin=null, $service=null){ }


		/**
		 * Sets transaction manager related to the transaction
		 *
		 * @param \Phalcon\Mvc\Model\Transaction\ManagerInterface $manager
		 */
		public function setTransactionManager($manager){ }


		/**
		 * Starts the transaction
		 *
		 * @return boolean
		 */
		public function begin(){ }


		/**
		 * Commits the transaction
		 *
		 * @return boolean
		 */
		public function commit(){ }


		/**
		 * Rolls back the transaction
		 *
		 * @param  string $rollbackMessage
		 * @param  \Phalcon\Mvc\ModelInterface $rollbackRecord
		 * @return boolean
		 */
		public function rollback($rollbackMessage=null, $rollbackRecord=null){ }


		/**
		 * Returns the connection related to transaction
		 *
		 * @return \Phalcon\Db\AdapterInterface
		 */
		public function getConnection(){ }


		/**
		 * Sets if is a reused transaction or new once
		 *
		 * @param boolean $isNew
		 */
		public function setIsNewTransaction($isNew){ }


		/**
		 * Sets flag to rollback on abort the HTTP connection
		 *
		 * @param boolean $rollbackOnAbort
		 */
		public function setRollbackOnAbort($rollbackOnAbort){ }


		/**
		 * Checks whether transaction is managed by a transaction manager
		 *
		 * @return boolean
		 */
		public function isManaged(){ }


		/**
		 * Returns validations messages from last save try
		 *
		 * @return array
		 */
		public function getMessages(){ }


		/**
		 * Checks whether internal connection is under an active transaction
		 *
		 * @return boolean
		 */
		public function isValid(){ }


		/**
		 * Sets object which generates rollback action
		 *
		 * @param \Phalcon\Mvc\ModelInterface $record
		 */
		public function setRollbackedRecord($record){ }

	}
}
