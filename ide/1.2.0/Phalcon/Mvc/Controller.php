<?php 

namespace Phalcon\Mvc {

	/**
	 * Phalcon\Mvc\Controller
	 *
	 * Every application controller should extend this class that encapsulates all the controller functionality
	 *
	 * The controllers provide the “flow” between models and views. Controllers are responsible
	 * for processing the incoming requests from the web browser, interrogating the models for data,
	 * and passing that data on to the views for presentation.
	 *
	 *<code>
	 *
	 *class PeopleController extends \Phalcon\Mvc\Controller
	 *{
	 *
	 *  //This action will be executed by default
	 *  public function indexAction()
	 *  {
	 *
	 *  }
	 *
	 *  public function findAction()
	 *  {
	 *
	 *  }
	 *
	 *  public function saveAction()
	 *  {
	 *   //Forwards flow to the index action
	 *   return $this->dispatcher->forward(array('controller' => 'people', 'action' => 'index'));
	 *  }
	 *
	 *}
	 *
	 *</code>
	 */
	
	abstract class Controller extends \Phalcon\DI\Injectable implements \Phalcon\Events\EventsAwareInterface, \Phalcon\DI\InjectionAwareInterface {

		/**
		 * \Phalcon\Mvc\Controller constructor
		 *
		 */
		final public function __construct(){ }

	}
}
