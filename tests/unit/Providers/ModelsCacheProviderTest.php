<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\ModelsCacheProvider;
use Phalcon\Di\ServiceProviderInterface;

final class ModelsCacheProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(ModelsCacheProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
