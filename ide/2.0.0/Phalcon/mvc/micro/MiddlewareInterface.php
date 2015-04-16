<?php

namespace Phalcon\Mvc\Micro;

interface MiddlewareInterface
{

    /**
     * Calls the middleware
     *
     * @param \Phalcon\Mvc\Micro $application 
     */
	public function call(\Phalcon\Mvc\Micro $application);

}
