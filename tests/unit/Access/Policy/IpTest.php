<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Unit\Access\Policy;

use Codeception\Test\Unit;
use Phalcon\DevTools\Access\Policy\Ip;
use ReflectionClass;
use ReflectionException;

final class IpTest extends Unit
{
    public function IPsDataProvider(): array
    {
        return [
            ['127.0.0.1', '127.0.0.1', true],
            [' 192.168.1.1 ', '192.168.1.1', true],
            ['8.8.8.8', '7.7.7.7', false],
        ];
    }

    /**
     * @dataProvider IPsDataProvider
     *
     * @param string $ip
     * @param string $allowedIp
     * @param bool $expected
     * @throws ReflectionException
     */
    public function testCheckIp(string $ip, string $allowedIp, bool $expected): void
    {
        $class = new ReflectionClass(Ip::class);
        $checkIpMethod = $class->getMethod('checkIp');
        $checkIpMethod->setAccessible(true);

        $ipClass = new Ip($ip);

        $this->assertSame($expected, $checkIpMethod->invokeArgs($ipClass, [$allowedIp]));
    }
}
