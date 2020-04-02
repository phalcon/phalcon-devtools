<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use MySQLTester;

final class SystemInfoControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\SystemInfoController::indexAction
     *
     * @param MySQLTester $I
     */
    public function testIndexAction(MySQLTester $I): void
    {
        $I->amOnPage('/webtools.php/info');
        $I->see('System Info');
        $I->see('General information about the application');
    }
}
