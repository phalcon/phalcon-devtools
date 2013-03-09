<?php 

namespace Phalcon\Cache\Frontend {

	class Base64 implements \Phalcon\Cache\FrontendInterface {

		protected $_frontendOptions;

		public function __construct($frontendOptions=null){ }


		public function getLifetime(){ }


		public function isBuffering(){ }


		public function start(){ }


		public function getContent(){ }


		public function stop(){ }


		public function beforeStore($data){ }


		public function afterRetrieve($data){ }

	}
}
