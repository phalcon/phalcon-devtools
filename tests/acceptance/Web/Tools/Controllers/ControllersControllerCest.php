<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class ControllersControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ControllersController::indexAction
     * @param AcceptanceTester $I
     */
    public function testIndexAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/controllers/list');
        $I->see('Controllers List');
        $I->see('All controllers that we managed to find');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ControllersController::generateAction
     * @param AcceptanceTester $I
     */
    public function testGenerateAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/controllers/generate');
        $I->see('Controllers');
        $I->see('Generate Controller');
    }

    public function testSubmitGenerateAction(AcceptanceTester $I): void
    {
        $controllerName = 'TestControllerName';

        $I->amOnPage('/webtools.php/controllers/generate');
        $I->fillField('name', $controllerName);
        $I->fillField('namespace', 'Test\WebTools');
        $I->click('.form-horizontal input[type=submit]');
        $I->see('All controllers that we managed to find');
        $I->see($controllerName . 'Controller');
    }
}
