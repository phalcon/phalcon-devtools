<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Phalcon\DevTools\Access;

use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\ManagerInterface;

/**
 * @property ManagerInterface $eventsManager
 */
class Manager extends Injectable
{
    const EXCEPTION_ACTION_DISALLOWED = 10;

    /**
     * The access policy instance.
     *
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
     * This action is executed before execute any action in the application.
     *
     * @param Event $event Event object.
     * @param Dispatcher $dispatcher Dispatcher object.
     * @param array $data Data.
     *
     * @return mixed
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher, array $data = null)
    {
        $controller = $dispatcher->getControllerName();

        if (!$this->isAllowedAccess($controller, $data)) {
            $this->eventsManager->fire(
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

    /**
     * Checks whether a user is allowed to access an resource.
     *
     * @param string $resourceName Resource name.
     * @param array $data Data. [Optional]
     * @return bool
     */
    public function isAllowedAccess(string $resourceName, array $data = null): bool
    {
        return $resourceName == 'error' || $this->policy->isAllowedAccess($resourceName, $data);
    }
}
