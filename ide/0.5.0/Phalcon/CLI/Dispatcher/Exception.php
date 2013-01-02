<?php 

namespace Phalcon\CLI\Dispatcher {

	class Exception extends \Phalcon\Exception {

		protected $message;

		protected $code;

		protected $file;

		protected $line;
	}
}
