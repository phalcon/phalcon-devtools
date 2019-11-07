<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\FlashProvider;
use Phalcon\Di\ServiceProviderInterface;

final class FileSystemProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(FlashProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
