<?php 

namespace Phalcon {

	class Exception extends \Exception {

		protected $message;

		protected $code;

		protected $file;

		protected $line;
	}
}
