<?php 

namespace Phalcon\DI {

	class Exception extends \Phalcon\Exception {

		protected $message;

		protected $code;

		protected $file;

		protected $line;
	}
}
