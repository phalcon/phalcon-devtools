<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\BehaviorInterface initializer
	 */
	
	interface BehaviorInterface {

		/**
		 * This method receives the notifications from the EventsManager
		 *
		 * @param string $type
		 * @param \Phalcon\Mvc\ModelInterface $model
		 */
		public function notify($type, $model);


		/**
		 * Calls a method when it's missing in the model
		 *
		 * @param \Phalcon\Mvc\ModelInterface $model
		 * @param string $method
		 * @param array $arguments
		 */
		public function missingMethod($model, $method, $arguments=null);

	}
}
