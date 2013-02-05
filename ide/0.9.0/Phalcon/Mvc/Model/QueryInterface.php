<?php 

namespace Phalcon\Mvc\Model {

	/**
	 * Phalcon\Mvc\Model\QueryInterface initializer
	 */
	
	interface QueryInterface {

		/**
		 * \Phalcon\Mvc\Model\Query constructor
		 *
		 * @param string $phql
		 */
		public function __construct($phql);


		/**
		 * Parses the intermediate code produced by \Phalcon\Mvc\Model\Query\Lang generating another
		 * intermediate representation that could be executed by \Phalcon\Mvc\Model\Query
		 *
		 * @return array
		 */
		public function parse();


		/**
		 * Executes a parsed PHQL statement
		 *
		 * @param array $bindParams
		 * @param array $bindTypes
		 * @return mixed
		 */
		public function execute($bindParams=null, $bindTypes=null);

	}
}
