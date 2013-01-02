<?php 

namespace Phalcon\CLI\Console {

	class Exception extends \Phalcon\Exception {

		protected $message;

		protected $code;

		protected $file;

		protected $line;
	}
}
