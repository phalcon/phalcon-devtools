<?php

namespace Phalcon\Mvc\Model;

use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Transaction\ManagerInterface;


interface TransactionInterface
{

	/**
	 * Sets transaction manager related to the transaction
	 * 
	 * @param ManagerInterface $manager
	 */
	public function setTransactionManager(ManagerInterface $manager);

	/**
	 * Starts the transaction
	 *
	 * @return boolean
	 */
	public function begin();

	/**
	 * Commits the transaction
	 *
	 * @return boolean
	 */
	public function commit();

	/**
	 * Rollbacks the transaction
	 *
	 * @param string $rollbackMessage
	 * @param \Phalcon\Mvc\ModelInterface $rollbackRecord
	 * 
	 * @return boolean
	 */
	public function rollback($rollbackMessage=null, $rollbackRecord=null);

	/**
	 * Returns connection related to transaction
	 *
	 * @return string
	 */
	public function getConnection();

	/**
	 * Sets if is a reused transaction or new once
	 * 
	 * @param boolean $isNew
	 *
	 */
	public function setIsNewTransaction($isNew);

	/**
	 * Sets flag to rollback on abort the HTTP connection
	 * 
	 * @param boolean $rollbackOnAbort
	 *
	 */
	public function setRollbackOnAbort($rollbackOnAbort);

	/**
	 * Checks whether transaction is managed by a transaction manager
	 *
	 * @return boolean
	 */
	public function isManaged();

	/**
	 * Returns validations messages from last save try
	 *
	 * @return array
	 */
	public function getMessages();

	/**
	 * Checks whether internal connection is under an active transaction
	 *
	 * @return boolean
	 */
	public function isValid();

	/**
	 * Sets object which generates rollback action
	 * 
	 * @param ModelInterface $record
	 */
	public function setRollbackedRecord(ModelInterface $record);

}
