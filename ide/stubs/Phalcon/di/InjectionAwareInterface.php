<?php

namespace Phalcon\Di;

/**
 * Phalcon\Di\InjectionAwareInterface
 *
 * This interface must be implemented in those classes that uses internally the Phalcon\Di that creates them
 */
interface InjectionAwareInterface
{

    /**
     * Sets the dependency injector
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function setDI(\Phalcon\DiInterface $dependencyInjector);

    /**
     * Returns the internal dependency injector
     *
     * @return \Phalcon\DiInterface
     */
    public function getDI();

}
