<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\AssetsProvider;
use Phalcon\Di\ServiceProviderInterface;

final class AssetsProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(AssetsProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
