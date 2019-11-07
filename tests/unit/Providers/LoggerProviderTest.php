<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\LoggerProvider;
use Phalcon\Di\ServiceProviderInterface;

final class LoggerProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(LoggerProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
