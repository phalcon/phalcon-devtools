<?php 

namespace Phalcon\Tag {

	class Exception extends \Phalcon\Exception {

		protected $message;

		protected $code;

		protected $file;

		protected $line;
	}
}
