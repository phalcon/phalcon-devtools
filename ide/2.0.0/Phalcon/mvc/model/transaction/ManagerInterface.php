<?php

namespace Phalcon\Mvc\Model\Transaction;

interface ManagerInterface
{

    /**
     * Phalcon\Mvc\Model\Transaction\Manager
     *
     * @param \Phalcon\DiInterface $dependencyInjector 
     */
	public function __construct(\Phalcon\DiInterface $dependencyInjector = null);

    /**
     * Checks whether manager has an active transaction
     *
     * @return boolean 
     */
	public function has();

    /**
     * Returns a new \Phalcon\Mvc\Model\Transaction or an already created once
     *
     * @param boolean $autoBegin 
     * @return \Phalcon\Mvc\Model\TransactionInterface 
     */
	public function get($autoBegin = true);

    /**
     * Rollbacks active transactions within the manager
     */
	public function rollbackPendent();

    /**
     * Commmits active transactions within the manager
     */
	public function commit();

    /**
     * Rollbacks active transactions within the manager
     * Collect will remove transaction from the manager
     *
     * @param boolean $collect 
     */
	public function rollback($collect = false);

    /**
     * Notifies the manager about a rollbacked transaction
     *
     * @param \Phalcon\Mvc\Model\TransactionInterface $transaction 
     */
	public function notifyRollback(\Phalcon\Mvc\Model\TransactionInterface $transaction);

    /**
     * Notifies the manager about a commited transaction
     *
     * @param \Phalcon\Mvc\Model\TransactionInterface $transaction 
     */
	public function notifyCommit(\Phalcon\Mvc\Model\TransactionInterface $transaction);

    /**
     * Remove all the transactions from the manager
     */
	public function collectTransactions();

}
