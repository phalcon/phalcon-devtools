<?php 

namespace Phalcon\Di {

	interface ServiceInterface {

		public function __construct($name, $definition, $shared=null);


		public function getName();


		public function setShared($shared);


		public function isShared();


		public function setDefinition($definition);


		public function getDefinition();


		public function resolve($parameters=null, \Phalcon\DiInterface $dependencyInjector=null);


		public static function __set_state($attributes);

	}
}
