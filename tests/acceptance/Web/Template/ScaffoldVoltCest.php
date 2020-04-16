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

        Fixtures::add('tablename', 'genScaffold');
        Fixtures::add('pageename', 'genscaffold');

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
    public function testGenScaffoldFileExist(AcceptanceTester $I): void
    {
        $scaffoldControllerPath = app_path('controllers/GenscaffoldController.php');
        $scaffoldModelPath = app_path('models/Genscaffold.php');

        $I->seeFileFound($scaffoldControllerPath);
        $I->seeFileFound($scaffoldModelPath);
        $I->seeFileFound(app_path('views/layouts/genscaffold.phtml'));
        $I->seeFileFound(app_path('views/genscaffold/edit.phtml'));
        $I->seeFileFound(app_path('views/genscaffold/index.phtml'));
        $I->seeFileFound(app_path('views/genscaffold/new.phtml'));
        $I->seeFileFound(app_path('views/genscaffold/search.phtml'));
    }

    /**
     * @group mysql
     * @group pgsql
     */
    public function testSearchAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/genscaffold');
        $I->see('Scaffold');
        $I->see('Search '.Fixtures::get('pageename'));
        $I->see('Dateofbirth');
        $I->fillField('dateofbirth', '2019-04-17');
        $I->click('input[type=submit]');

        $I->see('Lillian');
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
