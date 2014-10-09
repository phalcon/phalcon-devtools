<?php 

namespace Phalcon\Mvc\Model\Transaction {

	/**
	 * Phalcon\Mvc\Model\Transaction\Failed
	 *
	 * This class will be thrown to exit a try/catch block for isolated transactions
	 */
	
	class Failed extends \Phalcon\Mvc\Model\Transaction\Exception {

		protected $_record;

		/**
		 * \Phalcon\Mvc\Model\Transaction\Failed constructor
		 *
		 * @param string $message
		 * @param \Phalcon\Mvc\ModelInterface $record
		 */
		public function __construct($message, $record){ }


		/**
		 * Returns validation record messages which stop the transaction
		 *
		 * @return \Phalcon\Mvc\Model\MessageInterface[]
		 */
		public function getRecordMessages(){ }


		/**
		 * Returns validation record messages which stop the transaction
		 *
		 * @return \Phalcon\Mvc\ModelInterface
		 */
		public function getRecord(){ }

	}
}
