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
        $basePath = Fixtures::get('base_path');

        Fixtures::add('controller', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'controllers' .
            DIRECTORY_SEPARATOR . 'GenscaffoldController.php');

        Fixtures::add('model', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'models' .
            DIRECTORY_SEPARATOR . 'Genscaffold.php');

        Fixtures::add('layout', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'layouts' .
            DIRECTORY_SEPARATOR . 'genscaffold.volt');

        Fixtures::add('views', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'genscaffold');

        Fixtures::add('views_edit', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'genscaffold' .
            DIRECTORY_SEPARATOR . 'edit.volt');

        Fixtures::add('views_index', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'genscaffold' .
            DIRECTORY_SEPARATOR . 'index.volt');

        Fixtures::add('views_new', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'genscaffold' .
            DIRECTORY_SEPARATOR . 'new.volt');

        Fixtures::add('views_search', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'genscaffold' .
            DIRECTORY_SEPARATOR . 'search.volt');

        $I->seeFileFound(Fixtures::get('controller'));
        $I->seeFileFound(Fixtures::get('model'));
        $I->seeFileFound(Fixtures::get('layout'));
        $I->seeFileFound(Fixtures::get('views_edit'));
        $I->seeFileFound(Fixtures::get('views_index'));
        $I->seeFileFound(Fixtures::get('views_search'));
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
    public function testSearchButtonAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/genscaffold/search?id=&firstname=&surname=&membertype=&dateofbirth=2019-04-17');
        $I->see('Search result');

        $I->click("Next");
        $I->click("Previous");
        $I->click("Last");
        $I->click("First");
    }


    /**
     * @group mysql
     * @group pgsql
     */
    public function testNewAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/genscaffold/new');
        $I->see('Create genscaffold');
        $I->fillField('firstname', 'jeremy');
        $I->fillField('surname', 'jenovateurs');
        $I->fillField('membertype', 'aaa');
        $I->fillField('dateofbirth', '2019-04-17');
        $I->click('input[type=submit]');
    }

    /**
     * @group mysql
     * @group pgsql
     */
    public function testEditAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/genscaffold/search?id=&firstname=&surname=&membertype=&dateofbirth=2019-04-17');
        $I->see('Search result');
        $I->click("a[href*='edit/2']");
        $I->see('Lillian');
        $I->fillField('firstname', 'jeremy');
        $I->click('input[type=submit]');
    }

    /**
     * @group mysql
     * @group pgsql
     */
    public function testDeleteAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/genscaffold/search?id=&firstname=&surname=&membertype=&dateofbirth=2019-04-17');
        $I->see('Search result');
        $I->click("a[href*='delete/2']");
        $I->see('genscaffold was deleted successfully');

        $I->amOnPage('/genscaffold/search?id=&firstname=&surname=&membertype=&dateofbirth=2019-04-17');
        $I->cantSee('Lilian');
        $I->click('input[type=submit]');
    }

    /**
     * @group mysql
     * @group pgsql
     */
    public function after(AcceptanceTester $I): void
    {
        $I->deleteFile(Fixtures::get('controller'));
        $I->deleteFile(Fixtures::get('model'));
        $I->deleteFile(Fixtures::get('layout'));
        $I->deleteDir(Fixtures::get('views'));
    }
}
