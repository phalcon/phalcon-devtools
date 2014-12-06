<?php 

namespace Phalcon\Mvc\Model\Query {

	interface StatusInterface {

		public function __construct($success, \Phalcon\Mvc\ModelInterface $model);


		public function getModel();


		public function getMessages();


		public function success();

	}
}
