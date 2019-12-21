<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Access;

use Codeception\Test\Unit;
use Phalcon\DevTools\Access\Manager;
use Phalcon\Di\Injectable;

final class ManagerTest extends Unit
{
    public function testConstructor(): void
    {
        $class = $this->createMock(Manager::class);

        $this->assertInstanceOf(Injectable::class, $class);
    }
}
