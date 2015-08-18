<?php

namespace Phalcon\Queue;

/**
 * Phalcon\Queue\Beanstalk
 * Class to access the beanstalk queue service.
 * Partially implements the protocol version 1.2
 *
 * @see http://www.igvita.com/2010/05/20/scalable-work-queues-with-beanstalk/
 */
class Beanstalk
{

    protected $_connection;


    protected $_parameters;


    /**
     * Phalcon\Queue\Beanstalk
     *
     * @param array $options 
     */
    public function __construct($options = null) {}

    /**
     * Makes a connection to the Beanstalkd server
     *
     * @return resource 
     */
    public function connect() {}

    /**
     * Inserts jobs into the queue
     *
     * @param string $data 
     * @param array $options 
     * @return string|bool 
     */
    public function put($data, $options = null) {}

    /**
     * Reserves a job in the queue
     *
     * @param mixed $timeout 
     * @return bool|\Phalcon\Queue\Beanstalk\Job 
     */
    public function reserve($timeout = null) {}

    /**
     * Change the active tube. By default the tube is "default"
     *
     * @param string $tube 
     * @return bool|string 
     */
    public function choose($tube) {}

    /**
     * Change the active tube. By default the tube is "default"
     *
     * @param string $tube 
     * @return bool|string 
     */
    public function watch($tube) {}

    /**
     * Get stats of the Beanstalk server.
     *
     * @return bool|array 
     */
    public function stats() {}

    /**
     * Get stats of a tube.
     *
     * @param string $tube 
     * @return bool|array 
     */
    public function statsTube($tube) {}

    /**
     * Get list of a tubes.
     *
     * @return bool|array 
     */
    public function listTubes() {}

    /**
     * Inspect the next ready job.
     *
     * @return bool|\Phalcon\Queue\Beanstalk\Job 
     */
    public function peekReady() {}

    /**
     * Return the next job in the list of buried jobs
     *
     * @return bool|\Phalcon\Queue\Beanstalk\Job 
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
     * @param int $length Number of bytes to read.
     * @return string|boolean or `false` on error.
     */
    public function read($length = 0) {}

    /**
     * Writes data to the socket. Performs a connection if none is available
     *
     * @param string $data 
     * @return bool|int 
     */
    protected function write($data) {}

    /**
     * Closes the connection to the beanstalk server.
     *
     * @return bool 
     */
    public function disconnect() {}

}
