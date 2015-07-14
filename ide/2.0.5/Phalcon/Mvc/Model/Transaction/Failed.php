<?php

namespace Phalcon\Mvc\Model\Transaction;

use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Transaction\Exception;
use Phalcon\Mvc\Model\MessageInterface;


class Failed extends Exception
{

	protected $_record = null;



	/**
	 * Phalcon\Mvc\Model\Transaction\Failed constructor
	 * 
	 * @param string $message
	 * @param ModelInterface $record
	 */
	public function __construct($message, ModelInterface $record=null) {}

	/**
	 * Returns validation record messages which stop the transaction
	 *
	 * @return MessageInterface[]
	 */
	public function getRecordMessages() {}

	/**
	 * Returns validation record messages which stop the transaction
	 *
	 * @return ModelInterface
	 */
	public function getRecord() {}

}
