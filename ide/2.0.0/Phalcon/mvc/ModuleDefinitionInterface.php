<?php

namespace Phalcon\Mvc;

interface ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector 
     */
	public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null);

    /**
     * Registers an autoloader related to the module
     *
     * @param \Phalcon\DiInterface $dependencyInjector 
     */
	public function registerServices(\Phalcon\DiInterface $dependencyInjector);

}
