<?php 

namespace Phalcon\Queue\Beanstalk {

	/**
	 * Phalcon\Queue\Beanstalk\Job initializer
	 */
	
	class Job {

		protected $_queue;

		protected $_id;

		protected $_body;

		/**
		 * \Phalcon\Queue\Beanstalk\Job constructor
		 */
		public function __construct($queue, $id, $body){ }


		/**
		 * Removes a job from the server entirely
		 *
		 * @param integer $id
		 * @return boolean
		 */
		public function delete(){ }

	}
}
