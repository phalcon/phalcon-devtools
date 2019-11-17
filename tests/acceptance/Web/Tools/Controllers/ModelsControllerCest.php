<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class ModelsControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ModelsController::indexAction
     * @param AcceptanceTester $I
     */
    public function testIndexAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/models/list');
        $I->see('Models');
        $I->see('All models that we managed to find');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ModelsController::generateAction
     * @param AcceptanceTester $I
     */
    public function testGenerateAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/models/generate');
        $I->see('Models');
        $I->see('Generate Model');
    }
}
