<?php 

namespace Phalcon\Queue {

	/**
	 * Phalcon\Queue\Beanstalk
	 *
	 * Class to access the beanstalk queue service.
	 * Partially implements the protocol version 1.2
	 *
	 * @see http://www.igvita.com/2010/05/20/scalable-work-queues-with-beanstalk/
	 */
	
	class Beanstalk {

		protected $_connection;

		protected $_parameters;

		/**
		 * \Phalcon\Queue\Beanstalk
		 *
		 * @param array $options
		 */
		public function __construct($options=null){ }


		public function connect(){ }


		/**
		 * Inserts jobs into the queue
		 *
		 * @param string $data
		 * @param array $options
		 */
		public function put($data, $options=null){ }


		/**
		 * Reserves a job in the queue
		 *
		 * @return boolean|Phalcon\Queue\Beanstalk\Job
		 */
		public function reserve($timeout=null){ }


		/**
		 * Change the active tube. By default the tube is 'default'
		 *
		 * @param string $tube
		 * @return string|boolean
		 */
		public function choose($tube){ }


		/**
		 * Change the active tube. By default the tube is 'default'
		 *
		 * @param string $tube
		 * @return string|boolean
		 */
		public function watch($tube){ }


		/**
		 * Inspect the next ready job.
		 *
		 * @return boolean|Phalcon\Queue\Beanstalk\Job
		 */
		public function peekReady(){ }


		/**
		 * Reads the latest status from the Beanstalkd server
		 *
		 * @return array
		 */
		protected function readStatus(){ }


		/**
		 * Reads a packet from the socket. Prior to reading from the socket will
		 * check for availability of the connection.
		 *
		 * @param int $length Number of bytes to read.
		 * @return string|boolean Data or `false` on error.
		 */
		public function read($length=null){ }


		/**
		 * Writes data to the socket. Performs a connection if none is available
		 *
		 * @param string $data
		 * @return integer|boolean
		 */
		protected function write(){ }


		/**
		 * Closes the connection to the beanstalk server.
		 *
		 * @return boolean
		 */
		public function disconnect(){ }

	}
}
