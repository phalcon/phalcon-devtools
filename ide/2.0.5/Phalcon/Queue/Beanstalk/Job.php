<?php

namespace Phalcon\Queue\Beanstalk;

class Job
{

	protected $_id;

	public function getId() {
		return $this->_id;
	}

	protected $_body;

	public function getBody() {
		return $this->_body;
	}

	protected $_queue;



	/**
	 * Phalcon\Queue\Beanstalk\Job
	 * 
	 * @param \Phalcon\Queue\Beanstalk $queue
	 * @param string $id
	 * @param string $body
	 *
	 */
	public function __construct($queue, $id, $body) {}

	/**
	 * Removes a job from the server entirely
	 *
	 * @return boolean
	 */
	public function delete() {}

	/**
	 * The release command puts a reserved job back into the ready queue (and marks
	 * its state as "ready") to be run by any client. It is normally used when the job
	 * fails because of a transitory error.
	 * 
	 * @param int $priority
	 * @param int $delay
	 *
	 * @return boolean
	 */
	public function release($priority=100, $delay) {}

	/**
	 * The bury command puts a job into the "buried" state. Buried jobs are put into
	 * a FIFO linked list and will not be touched by the server again until a client
	 * kicks them with the "kick" command.
	 * 
	 * @param int $priority
	 *
	 * @return boolean
	 */
	public function bury($priority=100) {}

	/**
	 * The `touch` command allows a worker to request more time to work on a job.
	 * This is useful for jobs that potentially take a long time, but you still
	 * want the benefits of a TTR pulling a job away from an unresponsive worker.
	 * A worker may periodically tell the server that it's still alive and processing
	 * a job (e.g. it may do this on `DEADLINE_SOON`). The command postpones the auto
	 * release of a reserved job until TTR seconds from when the command is issued.
	 *
	 * @return boolean
	 */
	public function touch() {}

	/**
	 * Move the job to the ready queue if it is delayed or buried.
	 *
	 * @return boolean
	 */
	public function kick() {}

	/**
	 * Get stats of the job.
	 *
	 * @return boolean|array
	 */
	public function stats() {}

	/**
	 * Checks if the job has been modified after unserializing the object
	 *
	 * @return void
	 */
	public function __wakeup() {}

}
