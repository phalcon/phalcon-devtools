<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class ErrorControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ErrorController::route404Action
     * @param AcceptanceTester $I
     * @group common
     */
    public function testRoute404Action(AcceptanceTester $I, $scenario): void
    {
        $scenario->skip('Deprecated approach');

        $I->amOnPage('/webtools.php/404');
        $I->see('404');
        $I->see('Not Found');
    }
}
