<?php

namespace Phalcon\Mvc;

/**
 * Phalcon\Mvc\Dispatcher
 *
 * Dispatching is the process of taking the request object, extracting the module name,
 * controller name, action name, and optional parameters contained in it, and then
 * instantiating a controller and calling an action of that controller.
 *
 * <code>
 * $di = new \Phalcon\Di();
 *
 * $dispatcher = new \Phalcon\Mvc\Dispatcher();
 *
 * $dispatcher->setDI($di);
 *
 * $dispatcher->setControllerName("posts");
 * $dispatcher->setActionName("index");
 * $dispatcher->setParams([]);
 *
 * $controller = $dispatcher->dispatch();
 * </code>
 */
class Dispatcher extends \Phalcon\Dispatcher implements \Phalcon\Mvc\DispatcherInterface
{

    protected $_handlerSuffix = "Controller";


    protected $_defaultHandler = "index";


    protected $_defaultAction = "index";


    /**
     * Sets the default controller suffix
     *
     * @param string $controllerSuffix
     */
    public function setControllerSuffix($controllerSuffix) {}

    /**
     * Sets the default controller name
     *
     * @param string $controllerName
     */
    public function setDefaultController($controllerName) {}

    /**
     * Sets the controller name to be dispatched
     *
     * @param string $controllerName
     */
    public function setControllerName($controllerName) {}

    /**
     * Gets last dispatched controller name
     *
     * @return string
     */
    public function getControllerName() {}

    /**
     * Gets previous dispatched namespace name
     *
     * @return string
     */
    public function getPreviousNamespaceName() {}

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
     */
    protected function _throwDispatchException($message, $exceptionCode = 0) {}

    /**
     * Handles a user exception
     *
     * @param \Exception $exception
     */
    protected function _handleException(\Exception $exception) {}

    /**
     * Possible controller class name that will be located to dispatch the request
     *
     * @return string
     */
    public function getControllerClass() {}

    /**
     * Returns the latest dispatched controller
     *
     * @return \Phalcon\Mvc\ControllerInterface
     */
    public function getLastController() {}

    /**
     * Returns the active controller in the dispatcher
     *
     * @return \Phalcon\Mvc\ControllerInterface
     */
    public function getActiveController() {}

}
