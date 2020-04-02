<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class SystemInfoControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\SystemInfoController::indexAction
     * @param AcceptanceTester $I
     */
    public function testIndexAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/info');
        $I->see('System Info');
        $I->see('General information about the application');
    }
}
