<?php

namespace Phalcon\Mvc;

use Phalcon\Mvc\DispatcherInterface;
use Phalcon\Mvc\Dispatcher\Exception;
use Phalcon\Events\ManagerInterface;
use Phalcon\Http\ResponseInterface;
use Phalcon\Mvc\ControllerInterface;
use Phalcon\Dispatcher as BaseDispatcher;


class Dispatcher extends BaseDispatcher implements DispatcherInterface
{

	protected $_handlerSuffix = 'Controller';

	protected $_defaultHandler = 'index';

	protected $_defaultAction = 'index';



	/**
	 * Sets the default controller suffix
	 * 
	 * @param string $controllerSuffix
	 *
	 * @return void
	 */
	public function setControllerSuffix($controllerSuffix) {}

	/**
	 * Sets the default controller name
	 * 
	 * @param string $controllerName
	 *
	 * @return void
	 */
	public function setDefaultController($controllerName) {}

	/**
	 * Sets the controller name to be dispatched
	 * 
	 * @param string $controllerName
	 *
	 * @return void
	 */
	public function setControllerName($controllerName) {}

	/**
	 * Gets last dispatched controller name
	 *
	 * @return string
	 */
	public function getControllerName() {}

	/**
	 * Gets previous dispatched controller name
	 *
	 * @return string
	 */
	public function getPreviousControllerName() {}

	/**
	 * Gets previous dispatched action name
	 *
	 * @return string
	 */
	public function getPreviousActionName() {}

	/**
	 * Throws an internal exception
	 * 
	 * @param string $message
	 * @param int $exceptionCode
	 *
	 * @return mixed
	 */
	protected function _throwDispatchException($message, $exceptionCode) {}

	/**
		 * Dispatcher exceptions automatically sends a 404 status
	 * 
	 * @param \Exception $exception
		 *
	 * @return mixed
	 */
	protected function _handleException(\Exception $exception) {}

	/**
	 * Possible controller class name that will be located to dispatch the request
	 *
	 * @return string
	 */
	public function getControllerClass() {}

	/**
	 * Returns the lastest dispatched controller
	 *
	 * @return ControllerInterface
	 */
	public function getLastController() {}

	/**
	 * Returns the active controller in the dispatcher
	 *
	 * @return ControllerInterface
	 */
	public function getActiveController() {}

}
