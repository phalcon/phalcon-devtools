<?php 

namespace Phalcon\Forms {

	/**
	 * Phalcon\Forms\Manager
	 *
	 * Manages forms whithin the application. Allowing the developer to access them from
	 * any part of the application
	 */
	
	class Manager {

		protected $_forms;

		public function create($name=null, $entity=null){ }


		/**
		 * Returns a form by its name
		 *
		 * @param string $name
		 * @return \Phalcon\Forms\Form
		 */
		public function get(){ }

	}
}
