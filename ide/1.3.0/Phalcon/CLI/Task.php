<?php 

namespace Phalcon\CLI {

	/**
	 * Phalcon\CLI\Task
	 *
	 * Every command-line task should extend this class that encapsulates all the task functionality
	 *
	 * A task can be used to run "tasks" such as migrations, cronjobs, unit-tests, or anything that you want.
	 * The Task class should at least have a "mainAction" method
	 *
	 *<code>
	 *
	 *class HelloTask extends \Phalcon\CLI\Task
	 *{
	 *
	 *  //This action will be executed by default
	 *  public function mainAction()
	 *  {
	 *
	 *  }
	 *
	 *  public function findAction()
	 *  {
	 *
	 *  }
	 *
	 *}
	 *
	 *</code>
	 */
	
	class Task extends \Phalcon\DI\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface {
	}
}
