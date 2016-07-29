<?php

namespace Phalcon\Mvc\Model\Transaction;

/**
 * Phalcon\Mvc\Model\Transaction\ManagerInterface
 * Interface for Phalcon\Mvc\Model\Transaction\Manager
 */
interface ManagerInterface
{

    /**
     * Checks whether manager has an active transaction
     *
     * @return bool 
     */
    public function has();

    /**
     * Returns a new \Phalcon\Mvc\Model\Transaction or an already created once
     *
     * @param bool $autoBegin 
     * @return \Phalcon\Mvc\Model\TransactionInterface 
     */
    public function get($autoBegin = true);

    /**
     * Rollbacks active transactions within the manager
     */
    public function rollbackPendent();

    /**
     * Commits active transactions within the manager
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
     * @param mixed $transaction 
     */
    public function notifyRollback(\Phalcon\Mvc\Model\TransactionInterface $transaction);

    /**
     * Notifies the manager about a committed transaction
     *
     * @param mixed $transaction 
     */
    public function notifyCommit(\Phalcon\Mvc\Model\TransactionInterface $transaction);

    /**
     * Remove all the transactions from the manager
     */
    public function collectTransactions();

}
