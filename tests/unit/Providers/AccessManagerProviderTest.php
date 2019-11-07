<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\AccessManagerProvider;
use Phalcon\Di\ServiceProviderInterface;

final class AccessManagerProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(AccessManagerProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
