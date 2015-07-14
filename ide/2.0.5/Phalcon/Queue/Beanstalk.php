<?php

namespace Phalcon\Queue;

use Phalcon\Queue\Beanstalk\Job;


class Beanstalk
{

	protected $_connection;

	protected $_parameters;



	/**
	 * Phalcon\Queue\Beanstalk
	 * 
	 * @param mixed $options
	 *
	 */
	public function __construct($options=null) {}

	/**
	 * Makes a connection to the Beanstalkd server
	 *
	 * @return resource
	 */
	public function connect() {}

	/**
	 * Inserts jobs into the queue
	 * 
	 * @param mixed $data
	 * @param mixed $options
	 *
	 *
	 * @return string|boolean
	 */
	public function put($data, $options=null) {}

	/**
		 * Priority is 100 by default
	 * 
	 * @param mixed $timeout
		 *
	 * @return boolean|Job
	 */
	public function reserve($timeout=null) {}

	/**
		 * The job is in the first position
		 * Next is the job length
		 * The body is serialized
		 * Create a beanstalk job abstraction
	 * 
	 * @param string $tube
		 *
	 * @return boolean|string
	 */
	public function choose($tube) {}

	/**
	 * Change the active tube. By default the tube is "default"
	 * 
	 * @param string $tube
	 *
	 * @return boolean|string
	 */
	public function watch($tube) {}

	/**
	 * Get stats of the Beanstalk server.
	 *
	 * @return boolean|array
	 */
	public function stats() {}

	/**
	 * Get stats of a tube.
	 * 
	 * @param string $tube
	 *
	 * @return boolean|array
	 */
	public function statsTube($tube) {}

	/**
	 * Inspect the next ready job.
	 *
	 * @return boolean|Job
	 */
	public function peekReady() {}

	/**
	 * Return the next job in the list of buried jobs
	 *
	 * @return boolean|Job
	 */
	public function peekBuried() {}

	/**
	 * Reads the latest status from the Beanstalkd server
	 *
	 * @return array
	 */
	final public function readStatus() {}

	/**
	 * Fetch a YAML payload from the Beanstalkd server
	 *
	 * @return array
	 */
	final public function readYaml() {}

	/**
	 * Reads a packet from the socket. Prior to reading from the socket will
	 * check for availability of the connection.
	 *
	 * @param int $length
	 * @param \int length Number of bytes to $read
	 * 
	 * @return boolean|string
	 `false` on error.
	 */
	public function read($length) {}

	/**
	 * Writes data to the socket. Performs a connection if none is available
	 * 
	 * @param string $data
	 *
	 * @return boolean|int
	 */
	protected function write($data) {}

	/**
	 * Closes the connection to the beanstalk server.
	 *
	 * @return boolean
	 */
	public function disconnect() {}

}
