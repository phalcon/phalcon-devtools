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
	
	class Manager implements \Phalcon\Mvc\Model\Transaction\ManagerInterface, \Phalcon\DI\InjectionAwareInterface {

		protected $_dependencyInjector;

		protected $_initialized;

		protected $_rollbackPendent;

		protected $_number;

		protected $_service;

		protected $_transactions;

		/**
		 * \Phalcon\Mvc\Model\Transaction\Manager constructor
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function __construct($dependencyInjector=null){ }


		/**
		 * Sets the dependency injection container
		 *
		 * @param \Phalcon\DiInterface $dependencyInjector
		 */
		public function setDI($dependencyInjector){ }


		/**
		 * Returns the dependency injection container
		 *
		 * @return \Phalcon\DiInterface
		 */
		public function getDI(){ }


		/**
		 * Sets the database service used to run the isolated transactions
		 *
		 * @param string $service
		 * @return \Phalcon\Mvc\Model\Transaction\Manager
		 */
		public function setDbService($service){ }


		/**
		 * Returns the database service used to isolate the transaction
		 *
		 * @return string
		 */
		public function getDbService(){ }


		/**
		 * Set if the transaction manager must register a shutdown function to clean up pendent transactions
		 *
		 * @param boolean $rollbackPendent
		 * @return \Phalcon\Mvc\Model\Transaction\Manager
		 */
		public function setRollbackPendent($rollbackPendent){ }


		/**
		 * Check if the transaction manager is registering a shutdown function to clean up pendent transactions
		 *
		 * @return boolean
		 */
		public function getRollbackPendent(){ }


		/**
		 * Checks whether the manager has an active transaction
		 *
		 * @return boolean
		 */
		public function has(){ }


		/**
		 * Returns a new \Phalcon\Mvc\Model\Transaction or an already created once
		 * This method registers a shutdown function to rollback active connections
		 *
		 * @param boolean $autoBegin
		 * @return \Phalcon\Mvc\Model\TransactionInterface
		 */
		public function get($autoBegin=null){ }


		/**
		 * Create/Returns a new transaction or an existing one
		 *
		 * @param boolean $autoBegin
		 * @return \Phalcon\Mvc\Model\TransactionInterface
		 */
		public function getOrCreateTransaction($autoBegin=null){ }


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
		public function rollback($collect=null){ }


		/**
		 * Notifies the manager about a rollbacked transaction
		 *
		 * @param \Phalcon\Mvc\Model\TransactionInterface $transaction
		 */
		public function notifyRollback($transaction){ }


		/**
		 * Notifies the manager about a commited transaction
		 *
		 * @param \Phalcon\Mvc\Model\TransactionInterface $transaction
		 */
		public function notifyCommit($transaction){ }


		/**
		 * Removes transactions from the TransactionManager
		 *
		 * @param \Phalcon\Mvc\Model\TransactionInterface $transaction
		 */
		protected function _collectTransaction(){ }


		/**
		 * Remove all the transactions from the manager
		 *
		 */
		public function collectTransactions(){ }

	}
}
