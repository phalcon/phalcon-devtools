<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class MigrationsControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::indexAction
     * @param AcceptanceTester $I
     */
    public function testIndexAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/migrations/list');
        $I->see('Migrations');
        $I->see('All migrations that we managed to find');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::runAction
     * @param AcceptanceTester $I
     */
    public function testRunAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/migrations/run');
        $I->see('Migrations');
        $I->see('Run Migration');
    }
}
