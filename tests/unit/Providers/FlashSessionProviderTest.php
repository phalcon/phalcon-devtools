<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\FlashSessionProvider;
use Phalcon\Di\ServiceProviderInterface;

final class FlashSessionProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(FlashSessionProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
