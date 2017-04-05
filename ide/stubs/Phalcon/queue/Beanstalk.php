<?php

namespace Phalcon\Queue;

/**
 * Phalcon\Queue\Beanstalk
 *
 * Class to access the beanstalk queue service.
 * Partially implements the protocol version 1.2
 *
 * <code>
 * use Phalcon\Queue\Beanstalk;
 *
 * $queue = new Beanstalk(
 *     [
 *         "host"       => "127.0.0.1",
 *         "port"       => 11300,
 *         "persistent" => true,
 *     ]
 * );
 * </code>
 *
 * @link http://www.igvita.com/2010/05/20/scalable-work-queues-with-beanstalk/
 */
class Beanstalk
{
    /**
     * Seconds to wait before putting the job in the ready queue.
     * The job will be in the "delayed" state during this time.
     *
     * @const integer
     */
    const DEFAULT_DELAY = 0;

    /**
     * Jobs with smaller priority values will be scheduled before jobs with larger priorities.
     * The most urgent priority is 0, the least urgent priority is 4294967295.
     *
     * @const integer
     */
    const DEFAULT_PRIORITY = 100;

    /**
     * Time to run - number of seconds to allow a worker to run this job.
     * The minimum ttr is 1.
     *
     * @const integer
     */
    const DEFAULT_TTR = 86400;

    /**
     * Default tube name
     *
     * @const string
     */
    const DEFAULT_TUBE = "default";

    /**
     * Default connected host
     *
     * @const string
     */
    const DEFAULT_HOST = "127.0.0.1";

    /**
     * Default connected port
     *
     * @const integer
     */
    const DEFAULT_PORT = 11300;

    /**
     * Connection resource
     *
     * @var resource
     */
    protected $_connection;

    /**
     * Connection options
     *
     * @var array
     */
    protected $_parameters;


    /**
     * Phalcon\Queue\Beanstalk
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = array()) {}

    /**
     * Makes a connection to the Beanstalkd server
     *
     * @return resource
     */
    public function connect() {}

    /**
     * Puts a job on the queue using specified tube.
     *
     * @param mixed $data
     * @param array $options
     * @return int|bool
     */
    public function put($data, array $options = null) {}

    /**
     * Reserves/locks a ready job from the specified tube.
     *
     * @param mixed $timeout
     * @return bool|\Phalcon\Queue\Beanstalk\Job
     */
    public function reserve($timeout = null) {}

    /**
     * Change the active tube. By default the tube is "default".
     *
     * @param string $tube
     * @return bool|string
     */
    public function choose($tube) {}

    /**
     * The watch command adds the named tube to the watch list for the current connection.
     *
     * @param string $tube
     * @return bool|int
     */
    public function watch($tube) {}

    /**
     * It removes the named tube from the watch list for the current connection.
     *
     * @param string $tube
     * @return bool|int
     */
    public function ignore($tube) {}

    /**
     * Can delay any new job being reserved for a given time.
     *
     * @param string $tube
     * @param int $delay
     * @return bool
     */
    public function pauseTube($tube, $delay) {}

    /**
     * The kick command applies only to the currently used tube.
     *
     * @param int $bound
     * @return bool|int
     */
    public function kick($bound) {}

    /**
     * Gives statistical information about the system as a whole.
     *
     * @return bool|array
     */
    public function stats() {}

    /**
     * Gives statistical information about the specified tube if it exists.
     *
     * @param string $tube
     * @return bool|array
     */
    public function statsTube($tube) {}

    /**
     * Returns a list of all existing tubes.
     *
     * @return bool|array
     */
    public function listTubes() {}

    /**
     * Returns the tube currently being used by the client.
     *
     * @return bool|string
     */
    public function listTubeUsed() {}

    /**
     * Returns a list tubes currently being watched by the client.
     *
     * @return bool|array
     */
    public function listTubesWatched() {}

    /**
     * Inspect the next ready job.
     *
     * @return bool|\Phalcon\Queue\Beanstalk\Job
     */
    public function peekReady() {}

    /**
     * Return the next job in the list of buried jobs.
     *
     * @return bool|\Phalcon\Queue\Beanstalk\Job
     */
    public function peekBuried() {}

    /**
     * Return the next job in the list of buried jobs.
     *
     * @return bool|\Phalcon\Queue\Beanstalk\Job
     */
    public function peekDelayed() {}

    /**
     * The peek commands let the client inspect a job in the system.
     *
     * @param int $id
     * @return bool|\Phalcon\Queue\Beanstalk\Job
     */
    public function jobPeek($id) {}

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
     * @return bool|string
     */
    public function read($length = 0) {}

    /**
     * Writes data to the socket. Performs a connection if none is available
     *
     * @param string $data
     * @return bool|int
     */
    public function write($data) {}

    /**
     * Closes the connection to the beanstalk server.
     *
     * @return bool
     */
    public function disconnect() {}

    /**
     * Simply closes the connection.
     *
     * @return bool
     */
    public function quit() {}

}
