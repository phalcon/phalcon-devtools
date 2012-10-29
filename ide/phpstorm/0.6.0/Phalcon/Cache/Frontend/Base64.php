<?php 

namespace Phalcon\Cache\Frontend {

	class Base64 {

		protected $_frontendOptions;

		public function __construct($frontendOptions){ }


		public function getLifetime(){ }


		public function isBuffering(){ }


		public function start(){ }


		public function getContent(){ }


		public function stop(){ }


		public function beforeStore($data){ }


		public function afterRetrieve($data){ }

	}
}
