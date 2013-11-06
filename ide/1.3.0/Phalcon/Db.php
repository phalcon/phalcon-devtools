<?php 

namespace Phalcon {

	/**
	 * Phalcon\Db
	 *
	 * Phalcon\Db and its related classes provide a simple SQL database interface for Phalcon Framework.
	 * The Phalcon\Db is the basic class you use to connect your PHP application to an RDBMS.
	 * There is a different adapter class for each brand of RDBMS.
	 *
	 * This component is intended to lower level database operations. If you want to interact with databases using
	 * higher level of abstraction use Phalcon\Mvc\Model.
	 *
	 * Phalcon\Db is an abstract class. You only can use it with a database adapter like Phalcon\Db\Adapter\Pdo
	 *
	 * <code>
	 *
	 *try {
	 *
	 *  $connection = new Phalcon\Db\Adapter\Pdo\Mysql(array(
	 *     'host' => '192.168.0.11',
	 *     'username' => 'sigma',
	 *     'password' => 'secret',
	 *     'dbname' => 'blog',
	 *     'port' => '3306',
	 *  ));
	 *
	 *  $result = $connection->query("SELECT * FROM robots LIMIT 5");
	 *  $result->setFetchMode(Phalcon\Db::FETCH_NUM);
	 *  while ($robot = $result->fetch()) {
	 *    print_r($robot);
	 *  }
	 *
	 *} catch (Phalcon\Db\Exception $e) {
	 *	echo $e->getMessage(), PHP_EOL;
	 *}
	 *
	 * </code>
	 */
	
	abstract class Db {

		const FETCH_ASSOC = 1;

		const FETCH_BOTH = 2;

		const FETCH_NUM = 3;

		const FETCH_OBJ = 4;

		/**
		 * Enables/disables options in the Database component
		 *
		 * @param array $options
		 */
		public static function setup($options){ }

	}
}
