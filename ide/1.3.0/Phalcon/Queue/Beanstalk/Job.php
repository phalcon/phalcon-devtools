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
		 * @param mixed $body
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
		 * @return mixed
		 */
		public function getBody(){ }


		/**
		 * Removes a job from the server entirely
		 *
		 * @return boolean
		 */
		public function delete(){ }


		/**
		 * The release command puts a reserved job back into the ready queue (and marks
		 * its state as "ready") to be run by any client. It is normally used when the job
		 * fails because of a transitory error.
		 *
		 * @return boolean
		 */
		public function release(){ }


		/**
		 * The bury command puts a job into the "buried" state. Buried jobs are put into
		 * a FIFO linked list and will not be touched by the server again until a client
		 * kicks them with the "kick" command.
		 *
		 * @return boolean
		 */
		public function bury(){ }


		/**
		 * The bury command puts a job into the "buried" state. Buried jobs are put into
		 * a FIFO linked list and will not be touched by the server again until a client
		 * kicks them with the "kick" command.
		 *
		 * @return boolean
		 */
		public function touch(){ }


		/**
		 * Move the job to the ready queue if it is delayed or buried.
		 *
		 * @return boolean
		 */
		public function kick(){ }


		public function __wakeup(){ }

	}
}
