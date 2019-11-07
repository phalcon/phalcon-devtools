<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\VoltProvider;
use Phalcon\Di\ServiceProviderInterface;

final class VoltProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(VoltProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
