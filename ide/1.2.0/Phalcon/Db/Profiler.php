<?php 

namespace Phalcon\Db {

	/**
	 * Phalcon\Db\Profiler
	 *
	 * Instances of Phalcon\Db can generate execution profiles
	 * on SQL statements sent to the relational database. Profiled
	 * information includes execution time in miliseconds.
	 * This helps you to identify bottlenecks in your applications.
	 *
	 *<code>
	 *
	 *	$profiler = new Phalcon\Db\Profiler();
	 *
	 *	//Set the connection profiler
	 *	$connection->setProfiler($profiler);
	 *
	 *	$sql = "SELECT buyer_name, quantity, product_name
	 *	FROM buyers LEFT JOIN products ON
	 *	buyers.pid=products.id";
	 *
	 *	//Execute a SQL statement
	 *	$connection->query($sql);
	 *
	 *	//Get the last profile in the profiler
	 *	$profile = $profiler->getLastProfile();
	 *
	 *	echo "SQL Statement: ", $profile->getSQLStatement(), "\n";
	 *	echo "Start Time: ", $profile->getInitialTime(), "\n";
	 *	echo "Final Time: ", $profile->getFinalTime(), "\n";
	 *	echo "Total Elapsed Time: ", $profile->getTotalElapsedSeconds(), "\n";
	 *
	 *</code>
	 *
	 */
	
	class Profiler {

		protected $_allProfiles;

		protected $_activeProfile;

		protected $_totalSeconds;

		/**
		 * Starts the profile of a SQL sentence
		 *
		 * @param string $sqlStatement
		 * @return \Phalcon\Db\Profiler
		 */
		public function startProfile($sqlStatement){ }


		/**
		 * Stops the active profile
		 *
		 * @return \Phalcon\Db\Profiler
		 */
		public function stopProfile(){ }


		/**
		 * Returns the total number of SQL statements processed
		 *
		 * @return integer
		 */
		public function getNumberTotalStatements(){ }


		/**
		 * Returns the total time in seconds spent by the profiles
		 *
		 * @return double
		 */
		public function getTotalElapsedSeconds(){ }


		/**
		 * Returns all the processed profiles
		 *
		 * @return \Phalcon\Db\Profiler\Item[]
		 */
		public function getProfiles(){ }


		/**
		 * Resets the profiler, cleaning up all the profiles
		 *
		 * @return \Phalcon\Db\Profiler
		 */
		public function reset(){ }


		/**
		 * Returns the last profile executed in the profiler
		 *
		 * @return \Phalcon\Db\Profiler\Item
		 */
		public function getLastProfile(){ }

	}
}
