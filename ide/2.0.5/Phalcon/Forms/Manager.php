<?php

namespace Phalcon\Forms;

class Manager
{

	protected $_forms;



	/**
	 * Creates a form registering it in the forms manager
	 *
	 * @param string $name
	 * @param object $entity
	 * 
	 * @return Form
	 */
	public function create($name=null, $entity=null) {}

	/**
	 * Returns a form by its name
	 * 
	 * @param string $name
	 *
	 * @return Form
	 */
	public function get($name) {}

	/**
	 * Checks if a form is registered in the forms manager
	 * 
	 * @param string $name
	 *
	 * @return boolean
	 */
	public function has($name) {}

	/**
	 * Registers a form in the Forms Manager
	 * 
	 * @param string $name
	 * @param Form $form
	 *
	 * @return \FormManager
	 */
	public function set($name, Form $form) {}

}
