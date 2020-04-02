<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Tools\Controllers;

use MySQLTester;

final class MigrationsControllerCest
{
    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::indexAction
     *
     * @param MySQLTester $I
     */
    public function testIndexAction(MySQLTester $I): void
    {
        $I->amOnPage('/webtools.php/migrations/list');
        $I->see('Migrations');
        $I->see('All migrations that we managed to find');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::runAction
     *
     * @param MySQLTester $I
     */
    public function testEnterRunAction(MySQLTester $I): void
    {
        $I->amOnPage('/webtools.php/migrations/run');
        $I->see('Migrations');
        $I->see('Run Migration');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::generateAction
     *
     * @param MySQLTester $I
     */
    public function testEnterGenerateAction(MySQLTester $I): void
    {
        $I->amOnPage('/webtools.php/migrations/generate');
        $I->see('Migrations');
        $I->see('Generate Migration');
    }

    /**
     * @covers \Phalcon\Devtools\Web\Tools\Controllers\MigrationsController::generateAction
     *
     * @param MySQLTester $I
     */
    public function testGenerateAction(MySQLTester $I): void
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
     *
     * @param MySQLTester $I
     */
    public function testRunAction(MySQLTester $I): void
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
