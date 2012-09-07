<?php 

namespace Phalcon\Events {

	class Event {

		protected $_type;

		protected $_source;

		public function __construct($type, $source){ }


		public function setType($eventType){ }


		public function getType(){ }


		public function getSource(){ }

	}
}
