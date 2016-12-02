<?php

namespace Phalcon;

/**
 * Phalcon\Application
 *
 * Base class for Phalcon\Cli\Console and Phalcon\Mvc\Application.
 */
abstract class Application extends \Phalcon\Di\Injectable implements \Phalcon\Events\EventsAwareInterface
{

    protected $_eventsManager;


    protected $_dependencyInjector;

    /**
     * @var string
     */
    protected $_defaultModule;

    /**
     * @var array
     */
    protected $_modules = array();


    /**
     * Phalcon\Application
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function __construct(\Phalcon\DiInterface $dependencyInjector = null) {}

    /**
     * Sets the events manager
     *
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     * @return Application
     */
    public function setEventsManager(\Phalcon\Events\ManagerInterface $eventsManager) {}

    /**
     * Returns the internal event manager
     *
     * @return \Phalcon\Events\ManagerInterface
     */
    public function getEventsManager() {}

    /**
     * Register an array of modules present in the application
     *
     * <code>
     * $this->registerModules(
     *     [
     *         "frontend" => [
     *             "className" => "Multiple\\Frontend\\Module",
     *             "path"      => "../apps/frontend/Module.php",
     *         ],
     *         "backend" => [
     *             "className" => "Multiple\\Backend\\Module",
     *             "path"      => "../apps/backend/Module.php",
     *         ],
     *     ]
     * );
     * </code>
     *
     * @param array $modules
     * @param bool $merge
     * @return Application
     */
    public function registerModules(array $modules, $merge = false) {}

    /**
     * Return the modules registered in the application
     *
     * @return array
     */
    public function getModules() {}

    /**
     * Gets the module definition registered in the application via module name
     *
     * @param string $name
     * @return array|object
     */
    public function getModule($name) {}

    /**
     * Sets the module name to be used if the router doesn't return a valid module
     *
     * @param string $defaultModule
     * @return Application
     */
    public function setDefaultModule($defaultModule) {}

    /**
     * Returns the default module name
     *
     * @return string
     */
    public function getDefaultModule() {}

    /**
     * Handles a request
     */
    abstract public function handle();

}
