<?php
declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Acceptance\Web\Template;

use AcceptanceTester;
use Codeception\Util\Fixtures;
use Codeception\Util\Locator;

final class ScaffoldVoltCest
{
    /**
     * @group mysql
     */
    public function before(AcceptanceTester $I): void
    {
        $namespace = 'Test\WebTools';

        $I->amOnPage('/webtools.php/scaffold/generate');
        $I->selectOption('form select[name=templateEngine]', 'Volt');

        Fixtures::add('tablename', 'customers');

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
     */
    public function testGenScaffoldFileExist(AcceptanceTester $I): void
    {
        $basePath = Fixtures::get('base_path');

        Fixtures::add('controller', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'controllers' .
            DIRECTORY_SEPARATOR . 'CustomersController.php');

        Fixtures::add('model', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'models' .
            DIRECTORY_SEPARATOR . 'Customers.php');

        Fixtures::add('layout', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'layouts' .
            DIRECTORY_SEPARATOR . 'customers.volt');

        Fixtures::add('views', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'customers');

        Fixtures::add('views_edit', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'customers' .
            DIRECTORY_SEPARATOR . 'edit.volt');

        Fixtures::add('views_index', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'customers' .
            DIRECTORY_SEPARATOR . 'index.volt');

        Fixtures::add('views_new', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'customers' .
            DIRECTORY_SEPARATOR . 'new.volt');

        Fixtures::add('views_search', $basePath .
            DIRECTORY_SEPARATOR . 'app' .
            DIRECTORY_SEPARATOR . 'views' .
            DIRECTORY_SEPARATOR . 'customers' .
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
     */
    public function testSearchAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/'.Fixtures::get('tablename'));
        $I->see(Fixtures::get('tablename'));
        $I->see('Search '.Fixtures::get('tablename'));
        $I->see('Dateofbirth');
        $I->fillField('dateofbirth', '2019-04-17');
        $I->click('input[type=submit]');

        $I->see('Brandon');
    }

    /**
     * @group mysql
     */
    public function testSearchButtonAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/'.Fixtures::get('tablename').'/search');
        $I->see('Search result');

        $I->click("#next");

        $I->see("K1S6X");

        $I->click("#previous");

        $I->see("W2Q7K");

        $I->click("#last");

        $I->see("N2Z7T");

        $I->click("#first");

        $I->see("W2Q7K");
    }


    /**
     * @group mysql
     */
    public function testNewAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/'.Fixtures::get('tablename').'/new');
        $I->see('Create '.Fixtures::get('tablename'));
        $I->fillField('firstname', 'jeremy');
        $I->fillField('surname', 'jenovateurs');
        $I->fillField('membertype', 'aaa');
        $I->fillField('dateofbirth', '2019-04-17');
        $I->click('input[type=submit]');
    }

    /**
     * @group mysql
     */
    public function testEditAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/'.Fixtures::get('tablename').
            '/search');
        $I->see('Search result');
        $I->click(['link' => 'Edit']);
        $I->seeInField('firstname', 'Lillian');
        $I->fillField('firstname', 'samedi');
        $I->click('input[type=submit]');
        $I->amOnPage('/'.Fixtures::get('tablename').
            '/search');
        $I->see('Search result');
        //Check if edit work
       // $I->see('samedi');
    }

    /**
     * @group mysql
     */
    public function testDeleteAction(AcceptanceTester $I): void
    {
        $I->amOnPage('/'.Fixtures::get('tablename').
            '/search');
        $I->see('Search result');
        $I->click(['link' => 'Delete']);
        $I->see('customer was deleted successfully');

        $I->amOnPage('/'.Fixtures::get('tablename').
            '/search');
        $I->cantSee('samedi');
    }

    /**
     * @group mysql
     */
    public function after(AcceptanceTester $I): void
    {
        $I->deleteFile(Fixtures::get('controller'));
        $I->deleteFile(Fixtures::get('model'));
        $I->deleteFile(Fixtures::get('layout'));
        $I->deleteDir(Fixtures::get('views'));
    }
}
