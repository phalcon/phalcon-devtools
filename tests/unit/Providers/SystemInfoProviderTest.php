<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\SystemInfoProvider;
use Phalcon\Di\ServiceProviderInterface;

final class SystemInfoProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(SystemInfoProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
