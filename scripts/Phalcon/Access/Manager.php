<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2016 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Andres Gutierrez <andres@phalconphp.com>                      |
  |          Eduar Carvajal <eduar@phalconphp.com>                         |
  |          Serghei Iakovlev <serghei@phalconphp.com>                     |
  +------------------------------------------------------------------------+
*/

namespace Phalcon\Access;

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\User\Component;

/**
 * \Phalcon\Access\Manager
 *
 * @package Phalcon\Access
 */
class Manager extends Component
{
    const EXCEPTION_ACTION_DISALLOWED = 10;

    /**
     * The access policy instance.
     * @var PolicyInterface
     */
    protected $policy;

    /**
     * Manager constructor.
     *
     * @param PolicyInterface $policy
     */
    public function __construct(PolicyInterface $policy)
    {
        $this->policy = $policy;
    }

    /**
     * Checks whether a user is allowed to access an resource.
     *
     * @param string $resourceName Resource name.
     * @param array  $data         Data. [Optional]
     * @return bool
     */
    public function isAllowedAccess($resourceName, array $data = null)
    {
        return $resourceName == 'error' || $this->policy->isAllowedAccess($resourceName, $data);
    }

    /**
     * This action is executed before execute any action in the application.
     *
     * @param Event      $event      Event object.
     * @param Dispatcher $dispatcher Dispatcher object.
     * @param array      $data       Data.
     *
     * @return mixed
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher, array $data = null)
    {
        $controller = $dispatcher->getControllerName();

        if (!$this->isAllowedAccess($controller, $data)) {
            $this->getEventsManager()->fire(
                'dispatch:beforeException',
                $dispatcher,
                new Dispatcher\Exception(
                    sprintf('The access to the %s resource is denied.', $controller),
                    self::EXCEPTION_ACTION_DISALLOWED
                )
            );
        }

        return !$event->isStopped();
    }
}
