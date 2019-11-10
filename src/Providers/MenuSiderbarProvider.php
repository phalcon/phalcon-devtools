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

namespace Phalcon\DevTools\Providers;

use Phalcon\DevTools\Elements\Menu\SidebarMenu;
use Phalcon\Di\DiInterface;
use Phalcon\Di\ServiceProviderInterface;
use Phalcon\Registry;

class MenuSiderbarProvider implements ServiceProviderInterface
{
    /**
     * @var string
     */
    protected $providerName = 'sidebar';

    /**
     * Registers a service provider.
     *
     * @param DiInterface $di
     */
    public function register(DiInterface $di): void
    {
        $di->setShared($this->providerName, function () use ($di) {
            /**
             * @var Registry $registry
             */
            $registry = $di->getShared('registry');
            $menuItems = $registry->offsetGet('directories')->elementsDir . DS . 'sidebar-menu.php';
            /** @noinspection PhpIncludeInspection */
            return new SidebarMenu(include $menuItems);
        });
    }
}
