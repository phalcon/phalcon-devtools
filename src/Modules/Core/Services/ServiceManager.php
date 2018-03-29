<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-present Phalcon Team (https://www.phalconphp.com)   |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Sergii Svyrydenko <sergey.v.sviridenko@gmail.com>             |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Devtools\Modules\Core\Services;

use Phalcon\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Devtools\Modules\Core\Exceptions\InvalidArgumentException;

/**
 * Phalcon\Devtools\Modules\Core\Services\ServiceManager
 *
 * @package Phalcon\Devtools\Modules\Core\Services
 */
class ServiceManager implements ServiceManagerInterface
{
    /**@var DiInterface */
    protected $di;

    public function __construct(DiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * Register service
     *
     * @throws InvalidArgumentException
     * @return bool
     */
    public function register(string $service): bool
    {
        $serviceClass = $this->getServiceClass($service);
        $serviceObject = new $serviceClass;

        if ($serviceObject instanceof ServiceProviderInterface) {
            $serviceObject->register($this->di);

            return true;
        }

        return false;
    }

    protected function getServiceClass(string $service): string
    {
        $class = __NAMESPACE__ . "\\Services\\$service\\ServiceProvider";

        if (!class_exists($class)) {
            throw new InvalidArgumentException("Class '$class' was't defined yet");
        }

        return $class;
    }
}
