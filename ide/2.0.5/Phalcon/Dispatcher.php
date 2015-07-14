<?php

namespace Phalcon;

use Phalcon\DiInterface;
use Phalcon\FilterInterface;
use Phalcon\DispatcherInterface;
use Phalcon\Events\ManagerInterface;
use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Events\EventsAwareInterface;


abstract class Dispatcher implements DispatcherInterface, InjectionAwareInterface, EventsAwareInterface
{

	const EXCEPTION_NO_DI = 0;

	const EXCEPTION_CYCLIC_ROUTING = 1;

	const EXCEPTION_HANDLER_NOT_FOUND = 2;

	const EXCEPTION_INVALID_HANDLER = 3;

	const EXCEPTION_INVALID_PARAMS = 4;

	const EXCEPTION_ACTION_NOT_FOUND = 5;



	protected $_dependencyInjector;

	protected $_eventsManager;

	protected $_activeHandler;

	protected $_finished;

	protected $_forwarded = false;

	protected $_moduleName = null;

	protected $_namespaceName = null;

	protected $_handlerName = null;

	protected $_actionName = null;

	protected $_params;

	protected $_returnedValue = null;

	protected $_lastHandler = null;

	protected $_defaultNamespace = null;

	protected $_defaultHandler = null;

	protected $_defaultAction = '';

	protected $_handlerSuffix = '';

	protected $_actionSuffix = 'Action';

	protected $_previousHandlerName = null;

	protected $_previousActionName = null;



	/**
	 * Phalcon\Dispatcher constructor
	 */
	public function __construct() {}

	/**
	 * Sets the dependency injector
	 * 
	 * @param DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDI(DiInterface $dependencyInjector) {}

	/**
	 * Returns the internal dependency injector
	 *
	 * @return DiInterface
	 */
	public function getDI() {}

	/**
	 * Sets the events manager
	 * 
	 * @param ManagerInterface $eventsManager
	 *
	 * @return void
	 */
	public function setEventsManager(ManagerInterface $eventsManager) {}

	/**
	 * Returns the internal event manager
	 *
	 * @return ManagerInterface
	 */
	public function getEventsManager() {}

	/**
	 * Sets the default action suffix
	 * 
	 * @param string $actionSuffix
	 *
	 * @return void
	 */
	public function setActionSuffix($actionSuffix) {}

	/**
	 * Sets the module where the controller is (only informative)
	 * 
	 * @param string $moduleName
	 *
	 * @return void
	 */
	public function setModuleName($moduleName) {}

	/**
	 * Gets the module where the controller class is
	 *
	 * @return string
	 */
	public function getModuleName() {}

	/**
	 * Sets the namespace where the controller class is
	 * 
	 * @param string $namespaceName
	 *
	 * @return void
	 */
	public function setNamespaceName($namespaceName) {}

	/**
	 * Gets a namespace to be prepended to the current handler name
	 *
	 * @return string
	 */
	public function getNamespaceName() {}

	/**
	 * Sets the default namespace
	 * 
	 * @param string $namespaceName
	 *
	 * @return void
	 */
	public function setDefaultNamespace($namespaceName) {}

	/**
	 * Returns the default namespace
	 *
	 * @return string
	 */
	public function getDefaultNamespace() {}

	/**
	 * Sets the default action name
	 * 
	 * @param string $actionName
	 *
	 * @return void
	 */
	public function setDefaultAction($actionName) {}

	/**
	 * Sets the action name to be dispatched
	 * 
	 * @param string $actionName
	 *
	 * @return void
	 */
	public function setActionName($actionName) {}

	/**
	 * Gets the latest dispatched action name
	 *
	 * @return string
	 */
	public function getActionName() {}

	/**
	 * Sets action params to be dispatched
	 * 
	 * @param mixed $params
	 *
	 *
	 * @return mixed
	 */
	public function setParams($params) {}

	/**
	 * Gets action params
	 *
	 * @return array
	 */
	public function getParams() {}

	/**
	 * Set a param by its name or numeric index
	 * 
	 * @param mixed $param
	 * @param mixed $value
	 *
	 *
	 * @return void
	 */
	public function setParam($param, $value) {}

	/**
	 * Gets a param by its name or numeric index
	 *
	 * @param mixed $param
	 * @param string|array $filters
	 * @param mixed $defaultValue
	 * 
	 * @return mixed
	 */
	public function getParam($param, $filters=null, $defaultValue=null) {}

	/**
	 * Returns the current method to be/executed in the dispatcher
	 *
	 * @return string
	 */
	public function getActiveMethod() {}

	/**
	 * Checks if the dispatch loop is finished or has more pendent controllers/tasks to dispatch
	 *
	 * @return boolean
	 */
	public function isFinished() {}

	/**
	 * Sets the latest returned value by an action manually
	 * 
	 * @param mixed $value
	 *
	 *
	 * @return void
	 */
	public function setReturnedValue($value) {}

	/**
	 * Returns value returned by the lastest dispatched action
	 *
	 * @return mixed
	 */
	public function getReturnedValue() {}

	/**
	 * Dispatches a handle action taking into account the routing parameters
	 *
	 * @return mixed
	 */
	public function dispatch() {}

	/**
			 * Call the 'initialize' method just once per request
	 * 
	 * @param mixed $forward
			 *
	 * @return mixed
	 */
	public function forward($forward) {}

	/**
	 * Check if the current executed action was forwarded by another one
	 *
	 * @return boolean
	 */
	public function wasForwarded() {}

	/**
	 * Possible class name that will be located to dispatch the request
	 *
	 * @return string
	 */
	public function getHandlerClass() {}

	/**
	 * Set empty properties to their defaults (where defaults are available)
	 *
	 * @return void
	 */
	protected function _resolveEmptyProperties() {}

}
