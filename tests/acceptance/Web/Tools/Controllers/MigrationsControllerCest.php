<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use AcceptanceTester;

final class MigrationsControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::indexAction
     * @param AcceptanceTester $I
     * @group mysql
     * @group pgsql
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
     * @group mysql
     * @group pgsql
     */
    public function testEnterRunAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/migrations/run');
        $I->see('Migrations');
        $I->see('Run Migration');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::generateAction
     * @param AcceptanceTester $I
     * @group mysql
     * @group pgsql
     */
    public function testEnterGenerateAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/migrations/generate');
        $I->see('Migrations');
        $I->see('Generate Migration');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::generateAction
     * @param AcceptanceTester $I
     * @group mysql
     * @group pgsql
     */
    public function testGenerateAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/migrations/generate');
        $I->see('Migrations');
        $I->see('Generate Migration');

        $migrationsDir = $I->grabValueFrom('#migrationsDir');
        remove_dir($migrationsDir);

        $I->checkOption('#force');
        $I->click('input[type=submit]');
        $I->see('1.0.0');
        $I->see('The migration was generated successfully.');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::runAction
     * @param AcceptanceTester $I
     * @group mysql
     * @group pgsql
     */
    public function testRunAction(AcceptanceTester $I): void
    {
        $this->testGenerateAction($I);

        $I->amOnPage('/webtools.php/migrations/run');

        $basePath = $I->grabValueFrom('#basePath');
        $migrationVersion = $basePath . '/.phalcon/migration-version';
        @unlink($migrationVersion);
        file_put_contents($migrationVersion, '1.0.0');

        $I->see('Migrations');
        $I->see('Run Migration');
        $I->click('input[type=submit]');
        $I->see('Migrations List');
        $I->see('The migration was executed successfully.');
    }
}
