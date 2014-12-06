<?php 

namespace Phalcon\Acl {

	interface RoleInterface {

		public function __construct($name, $description=null);


		public function getName();


		public function getDescription();


		public function __toString();

	}
}
