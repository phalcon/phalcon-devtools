<?php 

namespace Phalcon\Queue\Beanstalk {

	/**
	 * Phalcon\Queue\Beanstalk\Job
	 *
	 * Represents a job in a beanstalk queue
	 */
	
	class Job {

		protected $_queue;

		protected $_id;

		protected $_body;

		/**
		 * \Phalcon\Queue\Beanstalk\Job
		 *
		 * @param \Phalcon\Queue\Beanstalk $queue
		 * @param string $id
		 * @param string $body
		 */
		public function __construct($queue, $id, $body){ }


		/**
		 * Returns the job id
		 *
		 * @return string
		 */
		public function getId(){ }


		/**
		 * Returns the job body
		 *
		 * @return string
		 */
		public function getBody(){ }


		/**
		 * Removes a job from the server entirely
		 *
		 * @param integer $id
		 * @return boolean
		 */
		public function delete(){ }

	}
}
