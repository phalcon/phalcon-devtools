<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\AssetsResourceProvider;
use Phalcon\Di\ServiceProviderInterface;

final class AssetsResourceProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(AssetsResourceProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
