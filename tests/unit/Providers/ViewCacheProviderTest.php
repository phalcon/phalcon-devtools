<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\ViewCacheProvider;
use Phalcon\Di\ServiceProviderInterface;

final class ViewCacheProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ViewCacheProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
