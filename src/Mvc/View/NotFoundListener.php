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

namespace Phalcon\DevTools\Mvc\View;

use Exception;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\ViewInterface;
use Psr\Log\LoggerInterface;

/**
 * @property LoggerInterface $logger
 */
class NotFoundListener extends Injectable
{
    /**
     * Notify about not found views.
     *
     * @param Event $event
     * @param ViewInterface $view
     * @param mixed $viewEnginePath
     *
     * @throws Exception
     */
    public function notFoundView(Event $event, ViewInterface $view, $viewEnginePath)
    {
        if ($viewEnginePath && !is_array($viewEnginePath)) {
            $viewEnginePath = [$viewEnginePath];
        }

        $message = sprintf(
            'View was not found in any of the views directory. Active render paths: [%s]',
            ($viewEnginePath ? join(', ', $viewEnginePath) : gettype($viewEnginePath))
        );

        $this->logger->error($message);

        throw new Exception($message);
    }
}
