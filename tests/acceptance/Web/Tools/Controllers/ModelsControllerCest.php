<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class ModelsControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ModelsController::indexAction
     * @param AcceptanceTester $I
     * @group mysql
     * @group pgsql
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
     * @group mysql
     * @group pgsql
     */
    public function testEnterGenerateAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/models/generate');
        $I->see('Models');
        $I->see('Generate Model');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ModelsController::generateAction
     * @param AcceptanceTester $I
     * @group mysql
     * @group pgsql
     */
    public function testGenerateAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/models/generate');

        $modelsDir = $I->grabValueFrom('#modelsDir');
        remove_dir($modelsDir);

        $I->fillField('namespace', 'Test\WebTools');
        $I->checkOption('#force');
        $I->click('input[type=submit]');
        $I->see('Models List');
        $I->see('TestMigrations');
        $I->see('Models were created successfully.');

        remove_dir($modelsDir);
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\ModelsController::editAction
     * @param AcceptanceTester $I
     * @group mysql
     * @group pgsql
     */
    public function testEditAction(AcceptanceTester $I): void
    {
        $newCode = '<?php echo "test";';

        /**
         * Generate Models
         */
        $I->amOnPage('/webtools.php/models/generate');

        $modelsDir = $I->grabValueFrom('#modelsDir');
        remove_dir($modelsDir);

        $I->fillField('namespace', 'Test\WebTools');
        $I->checkOption('#force');
        $I->click('input[type=submit]');
        $I->see('Models List');

        /**
         * Enter to edit Model Page
         */
        $I->click(".table a.btn-sm:nth-child(1)");
        $I->see('Editing Model');

        $modelName = explode('/', $I->grabFromCurrentUrl());
        $modelName = end($modelName);
        $modelName = str_replace('.php', '', $modelName);

        /**
         * Edit contents of Model
         */
        $I->fillField('code', $newCode);
        $I->click('form input[type=submit]');
        $I->see('The model "' . $modelName . '" was saved successfully.');

        /**
         * Check if contents was saved
         */
        $I->click(".table a.btn-sm:nth-child(1)");
        $I->see('Editing Model');
        $I->see($newCode);

        remove_dir($modelsDir);
    }
}
