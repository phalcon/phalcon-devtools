<?php 

namespace Phalcon\Forms {

	/**
	 * Phalcon\Forms\Manager
	 *
	 * Manages forms within the application. Allowing the developer to access them from
	 * any part of the application
	 */
	
	class Manager {

		protected $_forms;

		/**
		 * Creates a form registering it in the forms manager
		 *
		 * @param string $name
		 * @param object $entity
		 * @return \Phalcon\Forms\Form
		 */
		public function create($name=null, $entity=null){ }


		/**
		 * Returns a form by its name
		 *
		 * @param string $name
		 * @return \Phalcon\Forms\Form
		 */
		public function get($name){ }


		/**
		 * Checks if a form is registered in the forms manager
		 *
		 * @param string $name
		 * @return boolean
		 */
		public function has($name){ }


		/**
		 * Registers a form in the Forms Manager
		 *
		 * @param string $name
		 * @param \Phalcon\Forms\Form $form
		 * @return \Phalcon\Forms\Form
		 */
		public function set($name, $form){ }

	}
}
