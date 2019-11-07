<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\RouterProvider;
use Phalcon\Di\ServiceProviderInterface;

final class RouterProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(RouterProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
