<?php

namespace Phalcon\Cache\Frontend {

	use Phalcon\Cache\FrontendInterface;

    class Base64 implements FrontendInterface {

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
