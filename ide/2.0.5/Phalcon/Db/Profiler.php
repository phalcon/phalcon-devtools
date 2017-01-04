<?php

namespace Phalcon\Db;

use Phalcon\Db\Profiler\Item;


class Profiler
{

	/**
	 * All the Phalcon\Db\Profiler\Item in the active profile
	 *
	 * @var array
	 */
	protected $_allProfiles;

	/**
	 * Active Phalcon\Db\Profiler\Item
	 *
	 * @var Phalcon\Db\Profiler\Item
	 */
	protected $_activeProfile;

	/**
	 * Total time spent by all profiles to complete
	 *
	 * @var float
	 */
	protected $_totalSeconds;



	/**
	 * Starts the profile of a SQL sentence
	 *
	 * @param mixed $sqlStatement
	 * @param mixed $sqlVariables
	 * @param mixed $sqlBindTypes
	 * 
	 * @return Profiler
	 */
	public function startProfile($sqlStatement, $sqlVariables=null, $sqlBindTypes=null) {}

	/**
	 * Stops the active profile
	 *
	 * @return Profiler
	 */
	public function stopProfile() {}

	/**
	 * Returns the total number of SQL statements processed
	 *
	 * @return int
	 */
	public function getNumberTotalStatements() {}

	/**
	 * Returns the total time in seconds spent by the profiles
	 *
	 * @return double
	 */
	public function getTotalElapsedSeconds() {}

	/**
	 * Returns all the processed profiles
	 *
	 * @return Item[]
	 */
	public function getProfiles() {}

	/**
	 * Resets the profiler, cleaning up all the profiles
	 *
	 * @return Profiler
	 */
	public function reset() {}

	/**
	 * Returns the last profile executed in the profiler
	 *
	 * @return Item
	 */
	public function getLastProfile() {}

}
