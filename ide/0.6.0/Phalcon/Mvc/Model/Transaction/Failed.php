<?php 

namespace Phalcon\Mvc\Model\Transaction {

	/**
	 * Phalcon\Mvc\Model\Transaction\Failed
	 *
	 * Phalcon\Mvc\Model\Transaction\Failed will be thrown to exit a try/catch block for transactions
	 *
	 */
	
	class Failed extends \Exception {

		protected $_record;

		/**
		 * \Phalcon\Mvc\Model\Transaction\Failed constructor
		 *
		 * @param string $message
		 * @param \Phalcon\Mvc\Model $record
		 */
		public function __construct($message, $record){ }


		/**
		 * Returns validation record messages which stop the transaction
		 *
		 * @return string
		 */
		public function getRecordMessages(){ }


		/**
		 * Returns validation record messages which stop the transaction
		 *
		 * @return \Phalcon\Mvc\Model
		 */
		public function getRecord(){ }

	}
}
