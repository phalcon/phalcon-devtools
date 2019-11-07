<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\CacheProvider;
use Phalcon\Di\ServiceProviderInterface;

final class CacheProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(CacheProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
