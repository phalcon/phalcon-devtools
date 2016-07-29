<?php

namespace Phalcon;

/**
 * Phalcon\Dispatcher
 * This is the base class for Phalcon\Mvc\Dispatcher and Phalcon\Cli\Dispatcher.
 * This class can't be instantiated directly, you can use it to create your own dispatchers.
 */
abstract class Dispatcher implements \Phalcon\DispatcherInterface, \Phalcon\Di\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
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


    protected $_params = array();


    protected $_returnedValue = null;


    protected $_lastHandler = null;


    protected $_defaultNamespace = null;


    protected $_defaultHandler = null;


    protected $_defaultAction = "";


    protected $_handlerSuffix = "";


    protected $_actionSuffix = "Action";


    protected $_previousNamespaceName = null;


    protected $_previousHandlerName = null;


    protected $_previousActionName = null;


    protected $_modelBinding = false;


    /**
     * Sets the dependency injector
     *
     * @param mixed $dependencyInjector 
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector) {}

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface 
     */
    public function getDI() {}

    /**
     * Sets the events manager
     *
     * @param mixed $eventsManager 
     */
    public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface 
     */
    public function getEventsManager() {}

    /**
     * Sets the default action suffix
     *
     * @param string $actionSuffix 
     */
    public function setActionSuffix($actionSuffix) {}

    /**
     * Gets the default action suffix
     *
     * @return string 
     */
    public function getActionSuffix() {}

    /**
     * Sets the module where the controller is (only informative)
     *
     * @param string $moduleName 
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
     */
    public function setDefaultAction($actionName) {}

    /**
     * Sets the action name to be dispatched
     *
     * @param string $actionName 
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
     * @param array $params 
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
     */
    public function setParam($param, $value) {}

    /**
     * Gets a param by its name or numeric index
     *
     * @param mixed $param 
     * @param string|array $filters 
     * @param mixed $defaultValue 
     * @return mixed 
     */
    public function getParam($param, $filters = null, $defaultValue = null) {}

    /**
     * Check if a param exists
     *
     * @param mixed $param 
     * @return boolean 
     */
    public function hasParam($param) {}

    /**
     * Returns the current method to be/executed in the dispatcher
     *
     * @return string 
     */
    public function getActiveMethod() {}

    /**
     * Checks if the dispatch loop is finished or has more pendent controllers/tasks to dispatch
     *
     * @return bool 
     */
    public function isFinished() {}

    /**
     * Sets the latest returned value by an action manually
     *
     * @param mixed $value 
     */
    public function setReturnedValue($value) {}

    /**
     * Returns value returned by the latest dispatched action
     *
     * @return mixed 
     */
    public function getReturnedValue() {}

    /**
     * Enable/Disable model binding during dispatch
     *
     * @param boolean $value 
     */
    public function setModelBinding($value) {}

    /**
     * Dispatches a handle action taking into account the routing parameters
     *
     * @return object 
     */
    public function dispatch() {}

    /**
     * Dispatches a handle action taking into account the routing parameters
     *
     * @return object 
     */
    protected function _dispatch() {}

    /**
     * Forwards the execution flow to another controller/action
     * Dispatchers are unique per module. Forwarding between modules is not allowed
     * <code>
     * $this->dispatcher->forward(array("controller" => "posts", "action" => "index"));
     * </code>
     *
     * @param array $forward 
     */
    public function forward($forward) {}

    /**
     * Check if the current executed action was forwarded by another one
     *
     * @return bool 
     */
    public function wasForwarded() {}

    /**
     * Possible class name that will be located to dispatch the request
     *
     * @return string 
     */
    public function getHandlerClass() {}

    /**
     * @param mixed $handler 
     * @param string $actionMethod 
     * @param array $params 
     */
    public function callActionMethod($handler, $actionMethod, array $params = array()) {}

    /**
     * Set empty properties to their defaults (where defaults are available)
     */
    protected function _resolveEmptyProperties() {}

}
