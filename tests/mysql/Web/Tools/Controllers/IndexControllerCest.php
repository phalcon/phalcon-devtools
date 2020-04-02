<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use MySQLTester;

final class IndexControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\IndexController::indexAction
     *
     * @param MySQLTester $I
     */
    public function testIndexAction(MySQLTester $I): void
    {
        $I->amOnPage('/webtools.php/');
        $I->see('Dashboard');
        $I->see('Welcome to WebTools');

        $I->amOnPage('/webtools.php');
        $I->see('Dashboard');
        $I->see('Welcome to WebTools');
    }
}
