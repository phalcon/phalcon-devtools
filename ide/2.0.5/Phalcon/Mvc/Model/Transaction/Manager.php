<?php

namespace Phalcon\Mvc\Model\Transaction;

use Phalcon\DiInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Model\Transaction\ManagerInterface;
use Phalcon\Mvc\Model\Transaction\Exception;
use Phalcon\Mvc\Model\Transaction;
use Phalcon\Mvc\Model\TransactionInterface;


class Manager implements ManagerInterface, InjectionAwareInterface
{

	protected $_dependencyInjector;

	protected $_initialized = false;

	protected $_rollbackPendent = true;

	protected $_number;

	protected $_service = 'db';

	protected $_transactions;



	/**
	 * Phalcon\Mvc\Model\Transaction\Manager constructor
	 * 
	 * @param DiInterface $dependencyInjector
	 */
	public function __construct(DiInterface $dependencyInjector=null) {}

	/**
	 * Sets the dependency injection container
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the dependency injection container
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Sets the database service used to run the isolated transactions
	 * 
	 * @param string $service
	 *
	 * @return Manager
	 */
	public function setDbService($service) {}

	/**
	 * Returns the database service used to isolate the transaction
	 *
	 * @return mixed
	 */
	public function getDbService() {}

	/**
	 * Set if the transaction manager must register a shutdown function to clean up pendent transactions
	 * 
	 * @param boolean $rollbackPendent
	 *
	 * @return Manager
	 */
	public function setRollbackPendent($rollbackPendent) {}

	/**
	 * Check if the transaction manager is registering a shutdown function to clean up pendent transactions
	 *
	 * @return boolean
	 */
	public function getRollbackPendent() {}

	/**
	 * Checks whether the manager has an active transaction
	 *
	 * @return boolean
	 */
	public function has() {}

	/**
	 * Returns a new \Phalcon\Mvc\Model\Transaction or an already created once
	 * This method registers a shutdown function to rollback active connections
	 * 
	 * @param boolean $autoBegin
	 *
	 * @return TransactionInterface
	 */
	public function get($autoBegin=true) {}

	/**
	 * Create/Returns a new transaction or an existing one
	 * 
	 * @param boolean $autoBegin
	 *
	 * @return TransactionInterface
	 */
	public function getOrCreateTransaction($autoBegin=true) {}

	/**
	 * Rollbacks active transactions within the manager
	 *
	 * @return void
	 */
	public function rollbackPendent() {}

	/**
	 * Commmits active transactions within the manager
	 *
	 * @return void
	 */
	public function commit() {}

	/**
	 * Rollbacks active transactions within the manager
	 * Collect will remove the transaction from the manager
	 * 
	 * @param boolean $collect
	 *
	 *
	 * @return void
	 */
	public function rollback($collect=true) {}

	/**
	 * Notifies the manager about a rollbacked transaction
	 * 
	 * @param TransactionInterface $transaction
	 *
	 * @return void
	 */
	public function notifyRollback(TransactionInterface $transaction) {}

	/**
	 * Notifies the manager about a commited transaction
	 * 
	 * @param TransactionInterface $transaction
	 *
	 * @return void
	 */
	public function notifyCommit(TransactionInterface $transaction) {}

	/**
	 * Removes transactions from the TransactionManager
	 * 
	 * @param TransactionInterface $transaction
	 *
	 * @return void
	 */
	protected function _collectTransaction(TransactionInterface $transaction) {}

	/**
	 * Remove all the transactions from the manager
	 *
	 * @return void
	 */
	public function collectTransactions() {}

}
