<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Console;

use Codeception\Scenario;
use ConsoleTester;

/**
 * @var Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Generating models');
$I->amInPath(dirname(app_path()));

$modelsTestDir = app_path('models/model_test');
if (!is_dir($modelsTestDir)) {
    mkdir($modelsTestDir, 0777, true);
}

$file1 = app_path('models/model_test/TestModel.php');
$file2 = app_path('models/model_test/TestModel2.php');
$file3 = app_path('models/model_test/TestModel3.php');
$file4 = app_path('models/model_test/Testmodel4.php');

$I->dontSeeFileFound($file1);
$I->dontSeeFileFound($file2);
$I->dontSeeFileFound($file3);
$I->dontSeeFileFound($file4);

$I->runShellCommand('phalcon model --config=app/mysql/config.php --name=testModel --output=app/models/model_test --annotate');
$I->runShellCommand('phalcon model --config=app/mysql/config.php --name=test-model2 --output=app/models/model_test --annotate');
$I->runShellCommand('phalcon model --config=app/mysql/config.php --name=test_model3 --output=app/models/model_test --annotate');
$I->runShellCommand('phalcon model --config=app/mysql/config.php --name=Testmodel4 --output=app/models/model_test --annotate');

$I->seeFileFound($file1);
$I->seeFileFound($file2);
$I->seeFileFound($file3);
$I->seeFileFound($file4);

$content1 = file_get_contents($file1);
$content2 = file_get_contents($file2);
$content3 = file_get_contents($file3);
$content4 = file_get_contents($file4);

$I->openFile(app_path('models/model_test/TestModel.php'));
$I->seeFileContentsEqual($content1);

$I->openFile(app_path('models/model_test/TestModel2.php'));
$I->seeFileContentsEqual($content2);

$I->openFile(app_path('models/model_test/TestModel3.php'));
$I->seeFileContentsEqual($content3);

$I->openFile(app_path('models/model_test/Testmodel4.php'));
$I->seeFileContentsEqual($content4);

$I->deleteDir($modelsTestDir);
