<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\AnnotationsProvider;
use Phalcon\Di\ServiceProviderInterface;

final class AnnotationsProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(AnnotationsProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
