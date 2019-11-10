<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\RegistryProvider;
use Phalcon\Di\ServiceProviderInterface;

final class RegistryProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(RegistryProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
