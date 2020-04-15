<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Template;

use AcceptanceTester;
use Codeception\Util\Fixtures;

final class ScaffoldVoltCest
{
    /**
     * @group mysql
     * @group pgsql
     */
    public function before(AcceptanceTester $I): void
    {
        $namespace = 'Test\WebTools';

        $I->amOnPage('/webtools.php/scaffold/generate');
        $I->selectOption('form select[name=templateEngine]', 'Volt');

        Fixtures::add('tablename', 'genscaffold');

        $I->selectOption('form select[name=tableName]', Fixtures::get('tablename'));

        $basePath = $I->grabValueFrom('#basePath');
        Fixtures::add('base_path', $basePath);

        $I->fillField('modelsNamespace', $namespace);
        $I->checkOption('#force');
        $I->click('input[type=submit]');
        $I->see('Migrations');
        $I->see('All migrations that we managed to find');

        //add namespace in loader file
        $loaderFile = $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'config' .
            DIRECTORY_SEPARATOR . 'loader.php';

        $content = file_get_contents($loaderFile);

        //Add namespace
        $returnLine = "\r\n";

        $content .= $returnLine .
            '$loader->registerNamespaces(' .
                $returnLine . '[ '.
                    '"'.$namespace.'" => $config->application->modelsDir' .
                $returnLine . ' ]' .
            $returnLine . ');';

        file_put_contents($loaderFile, $content);
    }

    /**
     * @group mysql
     * @group pgsql
     */
    public function testSearchAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/'.Fixtures::get('tablename'));
        $I->see('Scaffold');
        $I->see('Search '.Fixtures::get('tablename'));
        $I->see('Dateofbirth');
        $I->fillField('dateofbirth', '2019-04-17');
        $I->click('input[type=submit]');
    }

    /**
     * @group mysql
     * @group pgsql
     */
    public function after(AcceptanceTester $I): void
    {
        $basePath = Fixtures::get('base_path');

        unlink($basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'controllers' .
            DIRECTORY_SEPARATOR . 'GenscaffoldController.php');

        unlink($basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'models' .
            DIRECTORY_SEPARATOR . 'Genscaffold.php');

        unlink($basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'layouts' .
            DIRECTORY_SEPARATOR . 'genscaffold.volt');

        remove_dir($basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'genscaffold');

        rmdir($basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'genscaffold');
    }
}
