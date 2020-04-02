<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Template;

use AcceptanceTester;
use Codeception\Util\Fixtures;

final class ScaffoldVoltCest
{
    public function before(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/scaffold/generate');
        $I->see('Scaffold');
        $I->see('Generate code from template');

        $basePath = $I->grabValueFrom('#basePath');
        Fixtures::add('base_path', $basePath);
      /*  $I->selectOption('form select[name=templateEngine]', 'Volt');
        $I->selectOption('form select[name=tableName]', 'genscaffold');
        $namespace = 'Test\WebTools';
        $I->fillField('modelsNamespace', $namespace);
        $I->click('input[type=submit]');
        $I->checkOption('#force');
        $I->see('Migrations');
        $I->see('All migrations that we managed to find');*/
        $I->selectOption('form select[name=templateEngine]', 'Volt');
        $I->selectOption('form select[name=tableName]', 'genscaffold');
        $I->checkOption('#force');
        $I->click('input[type=submit]');
        $I->see('Migrations');
        $I->see('All migrations that we managed to find');
    }

    public function testSearchAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/webtools.php/scaffold/generate');
        $I->see('Scaffold');
        $I->see('Generate code from template');
    }

    public function after(AcceptanceTester $I): void
    {
        $basePath = Fixtures::get('base_path');

        unlink($basePath .
            DIRECTORY_SEPARATOR . 'controllers' .
            DIRECTORY_SEPARATOR . 'GenscaffoldController.php');

        unlink($basePath .
            DIRECTORY_SEPARATOR . 'models' .
            DIRECTORY_SEPARATOR . 'Genscaffold.php');

        unlink($basePath .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'layouts' .
            DIRECTORY_SEPARATOR . 'genscaffold.phtml');

        remove_dir($basePath .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'genscaffold');
    }
}
