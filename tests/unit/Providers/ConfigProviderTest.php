<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\ConfigProvider;
use Phalcon\Di\ServiceProviderInterface;

final class ConfigProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ConfigProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
