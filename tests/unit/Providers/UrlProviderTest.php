<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\UrlProvider;
use Phalcon\Di\ServiceProviderInterface;

final class UrlProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(UrlProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
