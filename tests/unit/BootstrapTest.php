<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit;

use Codeception\Test\Unit;
use Phalcon\DevTools\Bootstrap;

final class BootstrapTest extends Unit
{
    public function testGetCurrentUri(): void
    {
        /** @var Bootstrap $class */
        $class = $this->createPartialMock(Bootstrap::class, ['getCurrentUri']);

        $this->assertIsString($class->getCurrentUri());
    }
}
