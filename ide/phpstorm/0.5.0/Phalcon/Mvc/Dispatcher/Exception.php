<?php 

namespace Phalcon\Mvc\Dispatcher {

	class Exception extends \Phalcon\Exception {

		protected $message;

		protected $code;

		protected $file;

		protected $line;
	}
}
