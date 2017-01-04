<?php

namespace Phalcon;

use \PDO as Pdo;


abstract class Db
{

	const FETCH_LAZY = \Pdo::FETCH_LAZY;

	const FETCH_ASSOC = \Pdo::FETCH_ASSOC;

	const FETCH_NAMED = \Pdo::FETCH_NAMED;

	const FETCH_NUM = \Pdo::FETCH_NUM;

	const FETCH_BOTH = \Pdo::FETCH_BOTH;

	const FETCH_OBJ = \Pdo::FETCH_OBJ;

	const FETCH_BOUND = \Pdo::FETCH_BOUND;

	const FETCH_COLUMN = \Pdo::FETCH_COLUMN;

	const FETCH_CLASS = \Pdo::FETCH_CLASS;

	const FETCH_INTO = \Pdo::FETCH_INTO;

	const FETCH_FUNC = \Pdo::FETCH_FUNC;

	const FETCH_GROUP = \Pdo::FETCH_GROUP;

	const FETCH_UNIQUE = \Pdo::FETCH_UNIQUE;

	const FETCH_KEY_PAIR = \Pdo::FETCH_KEY_PAIR;

	const FETCH_CLASSTYPE = \Pdo::FETCH_CLASSTYPE;

	const FETCH_SERIALIZE = \Pdo::FETCH_SERIALIZE;

	const FETCH_PROPS_LATE = \Pdo::FETCH_PROPS_LATE;



	/**
	 * Enables/disables options in the Database component
	 * 
	 * @param array $options
	 *
	 * @return void
	 */
	public static function setup(array $options) {}

}
