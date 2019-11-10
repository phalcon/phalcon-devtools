<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Providers;

use Codeception\Test\Unit;
use Phalcon\DevTools\Providers\DbUtilsProvider;
use Phalcon\Di\ServiceProviderInterface;

final class DbUtilsProviderTest extends Unit
{
    public function testImplementation(): void
    {
        $class = $this->createMock(DbUtilsProvider::class);

        $this->assertInstanceOf(ServiceProviderInterface::class, $class);
    }
}
