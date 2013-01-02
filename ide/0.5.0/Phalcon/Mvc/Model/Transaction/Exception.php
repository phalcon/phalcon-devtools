<?php 

namespace Phalcon\Mvc\Model\Transaction {

	class Exception extends \Phalcon\Mvc\Model\Exception {

		protected $message;

		protected $code;

		protected $file;

		protected $line;
	}
}
