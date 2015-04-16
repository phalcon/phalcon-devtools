<?php

namespace Phalcon\Mvc\Model\Transaction;

class Failed extends \Phalcon\Mvc\Model\Transaction\Exception
{

    protected $_record = null;


    /**
     * Phalcon\Mvc\Model\Transaction\Failed constructor
     *
     * @param string $message 
     * @param \Phalcon\Mvc\ModelInterface $record 
     */
	public function __construct($message, \Phalcon\Mvc\ModelInterface $record = null) {}

    /**
     * Returns validation record messages which stop the transaction
     *
     * @return \Phalcon\Mvc\Model\MessageInterface[] 
     */
	public function getRecordMessages() {}

    /**
     * Returns validation record messages which stop the transaction
     *
     * @return \Phalcon\Mvc\ModelInterface 
     */
	public function getRecord() {}

}
