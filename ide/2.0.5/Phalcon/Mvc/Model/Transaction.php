<?php

namespace Phalcon\Mvc\Model;

use Phalcon\DiInterface;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Transaction\Failed as TxFailed;
use Phalcon\Mvc\Model\Transaction\ManagerInterface;
use Phalcon\Mvc\Model\TransactionInterface;


class Transaction implements TransactionInterface
{

	protected $_connection;

	protected $_activeTransaction = false;

	protected $_isNewTransaction = true;

	protected $_rollbackOnAbort = false;

	protected $_manager;

	protected $_messages;

	protected $_rollbackRecord;



	/**
	 * Phalcon\Mvc\Model\Transaction constructor
	 * 
	 * @param DiInterface $dependencyInjector
	 * @param boolean $autoBegin
	 * @param string $service
	 *
	 */
	public function __construct(DiInterface $dependencyInjector, $autoBegin=false, $service=null) {}

	/**
	 * Sets transaction manager related to the transaction
	 * 
	 * @param ManagerInterface $manager
	 *
	 * @return void
	 */
	public function setTransactionManager(ManagerInterface $manager) {}

	/**
	 * Starts the transaction
	 *
	 * @return boolean
	 */
	public function begin() {}

	/**
	 * Commits the transaction
	 *
	 * @return boolean
	 */
	public function commit() {}

	/**
	 * Rollbacks the transaction
	 *
	 * @param string $rollbackMessage
	 * @param \Phalcon\Mvc\ModelInterface $rollbackRecord
	 * 
	 * @return boolean
	 */
	public function rollback($rollbackMessage=null, $rollbackRecord=null) {}

	/**
	 * Returns the connection related to transaction
	 *
	 * @return \Phalcon\Db\AdapterInterface
	 */
	public function getConnection() {}

	/**
	 * Sets if is a reused transaction or new once
	 * 
	 * @param boolean $isNew
	 *
	 * @return void
	 */
	public function setIsNewTransaction($isNew) {}

	/**
	 * Sets flag to rollback on abort the HTTP connection
	 * 
	 * @param boolean $rollbackOnAbort
	 *
	 * @return void
	 */
	public function setRollbackOnAbort($rollbackOnAbort) {}

	/**
	 * Checks whether transaction is managed by a transaction manager
	 *
	 * @return boolean
	 */
	public function isManaged() {}

	/**
	 * Returns validations messages from last save try
	 *
	 * @return array
	 */
	public function getMessages() {}

	/**
	 * Checks whether internal connection is under an active transaction
	 *
	 * @return boolean
	 */
	public function isValid() {}

	/**
	 * Sets object which generates rollback action
	 * 
	 * @param ModelInterface $record
	 *
	 * @return void
	 */
	public function setRollbackedRecord(ModelInterface $record) {}

}
