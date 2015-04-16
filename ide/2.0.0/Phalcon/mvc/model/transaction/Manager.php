<?php

namespace Phalcon\Mvc\Model\Transaction;

class Manager implements \Phalcon\Mvc\Model\Transaction\ManagerInterface, \Phalcon\Di\InjectionAwareInterface
{

    protected $_dependencyInjector;


    protected $_initialized = false;


    protected $_rollbackPendent = true;


    protected $_number = 0;


    protected $_service = "db";


    protected $_transactions;


    /**
     * Phalcon\Mvc\Model\Transaction\Manager constructor
     *
     * @param \Phalcon\DiInterface $dependencyInjector 
     */
	public function __construct(\Phalcon\DiInterface $dependencyInjector = null) {}

    /**
     * Sets the dependency injection container
     *
     * @param \Phalcon\DiInterface $dependencyInjector 
     */
	public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the dependency injection container
     *
     * @return \Phalcon\DiInterface 
     */
	public function getDI() {}

    /**
     * Sets the database service used to run the isolated transactions
     *
     * @param string $service 
     * @return \Phalcon\Mvc\Model\Transaction\Manager 
     */
	public function setDbService($service) {}

    /**
     * Returns the database service used to isolate the transaction
     *
     * @return string 
     */
	public function getDbService() {}

    /**
     * Set if the transaction manager must register a shutdown function to clean up pendent transactions
     *
     * @param boolean $rollbackPendent 
     * @return \Phalcon\Mvc\Model\Transaction\Manager 
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
     * @return \Phalcon\Mvc\Model\TransactionInterface 
     */
	public function get($autoBegin = true) {}

    /**
     * Create/Returns a new transaction or an existing one
     *
     * @param boolean $autoBegin 
     * @return \Phalcon\Mvc\Model\TransactionInterface 
     */
	public function getOrCreateTransaction($autoBegin = true) {}

    /**
     * Rollbacks active transactions within the manager
     */
	public function rollbackPendent() {}

    /**
     * Commmits active transactions within the manager
     */
	public function commit() {}

    /**
     * Rollbacks active transactions within the manager
     * Collect will remove the transaction from the manager
     *
     * @param boolean $collect 
     */
	public function rollback($collect = true) {}

    /**
     * Notifies the manager about a rollbacked transaction
     *
     * @param \Phalcon\Mvc\Model\TransactionInterface $transaction 
     */
	public function notifyRollback(\Phalcon\Mvc\Model\TransactionInterface $transaction) {}

    /**
     * Notifies the manager about a commited transaction
     *
     * @param \Phalcon\Mvc\Model\TransactionInterface $transaction 
     */
	public function notifyCommit(\Phalcon\Mvc\Model\TransactionInterface $transaction) {}

    /**
     * Removes transactions from the TransactionManager
     *
     * @param \Phalcon\Mvc\Model\TransactionInterface $transaction 
     */
	protected function _collectTransaction(\Phalcon\Mvc\Model\TransactionInterface $transaction) {}

    /**
     * Remove all the transactions from the manager
     */
	public function collectTransactions() {}

}
