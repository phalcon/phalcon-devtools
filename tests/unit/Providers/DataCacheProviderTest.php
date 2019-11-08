<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\DataCacheProvider;
use Phalcon\Di\ServiceProviderInterface;

final class DataCacheProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(DataCacheProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
