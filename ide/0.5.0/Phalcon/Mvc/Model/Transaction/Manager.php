<?php 

namespace Phalcon\Mvc\Model\Transaction {

	/**
	 * Phalcon\Mvc\Model\Transaction\Manager
	 *
	 * A transaction acts on a single database connection. If you have multiple class-specific
	 * databases, the transaction will not protect interaction among them.
	 *
	 * This class manages the objects that compose a transaction.
	 * A trasaction produces a unique connection that is passed to every
	 * object part of the transaction.
	 *
	  *<code>
	 *try {
	 *
	 *  use Phalcon\Mvc\Model\Transaction\Manager as TransactionManager;
	 *
	 *  $transactionManager = new TransactionManager();
	 *
	 *  $transaction = $transactionManager->get();
	 *
	 *  $robot = new Robots();
	 *  $robot->setTransaction($transaction);
	 *  $robot->name = 'WALL·E';
	 *  $robot->created_at = date('Y-m-d');
	 *  if($robot->save()==false){
	 *    $transaction->rollback("Can't save robot");
	 *  }
	 *
	 *  $robotPart = new RobotParts();
	 *  $robotPart->setTransaction($transaction);
	 *  $robotPart->type = 'head';
	 *  if($robotPart->save()==false){
	 *    $transaction->rollback("Can't save robot part");
	 *  }
	 *
	 *  $transaction->commit();
	 *
	 *}
	 *catch(Phalcon\Mvc\Model\Transaction\Failed $e){
	 *  echo 'Failed, reason: ', $e->getMessage();
	 *}
	 *
	 *</code>
	 *
	 */
	
	class Manager {

		protected $_dependencyInjector;

		protected $_initialized;

		protected $_number;

		protected $_transactions;

		public function __construct($dependencyInjector){ }


		/**
		 * Sets the dependency injection container
		 *
		 * @param \Phalcon\DI $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the dependency injection container
		 *
		 * @return \Phalcon\DI
		 */
		public function getDI(){ }


		/**
		 * Checks whether manager has an active transaction
		 *
		 * @return boolean
		 */
		public function has(){ }


		/**
		 * Returns a new \Phalcon\Mvc\Model\Transaction or an already created once
		 *
		 * @param boolean $autoBegin
		 * @return \Phalcon\Mvc\Model\Transaction
		 */
		public function get($autoBegin){ }


		/**
		 * Rollbacks active transactions within the manager
		 *
		 */
		public function rollbackPendent(){ }


		/**
		 * Commmits active transactions within the manager
		 *
		 */
		public function commit(){ }


		/**
		 * Rollbacks active transactions within the manager
		 * Collect will remove transaction from the manager
		 *
		 * @param boolean $collect
		 */
		public function rollback($collect){ }


		/**
		 * Notifies the manager about a rollbacked transaction
		 *
		 * @param \Phalcon\Mvc\Model\Transaction $transaction
		 */
		public function notifyRollback($transaction){ }


		/**
		 * Notifies the manager about a commited transaction
		 *
		 * @param \Phalcon\Mvc\Model\Transaction $transaction
		 */
		public function notifyCommit($transaction){ }


		private function _collectTransaction(){ }


		/**
		 * Remove all the transactions from the manager
		 *
		 */
		public function collectTransactions(){ }

	}
}
