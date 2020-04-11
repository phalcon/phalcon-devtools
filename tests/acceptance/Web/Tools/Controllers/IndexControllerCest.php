<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class IndexControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\IndexController::indexAction
     * @param AcceptanceTester $I
     * @group common
     */
    public function testIndexAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/');
        $I->see('Dashboard');
        $I->see('Welcome to WebTools');

        $I->amOnPage('/webtools.php');
        $I->see('Dashboard');
        $I->see('Welcome to WebTools');
    }
}
