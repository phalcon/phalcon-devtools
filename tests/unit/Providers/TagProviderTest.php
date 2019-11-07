<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\TagProvider;
use Phalcon\Di\ServiceProviderInterface;

final class TagProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(TagProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
