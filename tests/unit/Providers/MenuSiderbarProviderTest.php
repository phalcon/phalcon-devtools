<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\MenuSiderbarProvider;
use Phalcon\Di\ServiceProviderInterface;

final class MenuSiderbarProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(MenuSiderbarProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
