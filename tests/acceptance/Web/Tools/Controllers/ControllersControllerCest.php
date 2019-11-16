<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class ControllersControllerCest
{
    public function testIndex(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/controllers/list');
        $I->see('Controllers List');
        $I->see('All controllers that we managed to find');
    }
}
