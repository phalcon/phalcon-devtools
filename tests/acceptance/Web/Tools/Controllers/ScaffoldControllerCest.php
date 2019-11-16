<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class ScaffoldControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ScaffoldController::indexAction
     * @param AcceptanceTester $I
     */
    public function testIndexAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/scaffold/generate');
        $I->see('Scaffold');
        $I->see('Generate code from template');
    }
}
