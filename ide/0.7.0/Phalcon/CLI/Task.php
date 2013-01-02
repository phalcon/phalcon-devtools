<?php 

namespace Phalcon\CLI {

	/**
	 * Phalcon\CLI\Task
	 *
	 * Every command-line task should extend this class that encapsulates all the task functionality
	 *
	 * A task can be used to run "tasks" such as migrations, cronjobs, unit-tests, or anything that you want.
	 * The Task class should at least have a "runAction" method
	 *
	 *<code>
	 *
	 *class HelloTask extends \Phalcon\CLI\Task
	 *{
	 *
	 *  //This action will be executed by default
	 *  public function runAction()
	 *  {
	 *
	 *  }
	 *
	 *  public function findAction()
	 *  {
	 *
	 *  }
	 *
	 *  //This action will be executed when a non existent action is requested
	 *  public function notFoundAction()
	 *  {
	 *
	 *  }
	 *
	 *}
	 *
	 *</code>
	 */
	
	class Task extends \Phalcon\DI\Injectable {

		/**
		 * \Phalcon\CLI\Task constructor
		 */
		final public function __construct(){ }

	}
}
