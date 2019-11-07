<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Generating models');
$I->amInPath(dirname(app_path()));

$modelsTestDir = tests_path('_data/console/app/models/all_model_test');
if (!is_dir($modelsTestDir)) {
    mkdir($modelsTestDir, 0777, true);
}

$I->runShellCommand('phalcon all-models --config=app/mysql/config.php --output=app/models/all_model_test --annotate');

$I->seeFileFound(app_path('models/all_model_test/TestModel.php'));
$I->seeFileFound(app_path('models/all_model_test/TestModel2.php'));
$I->seeFileFound(app_path('models/all_model_test/TestModel3.php'));
$I->seeFileFound(app_path('models/all_model_test/Testmodel4.php'));

$file1 = file_get_contents(app_path('models/files/TestModel.php'));
$file2 = file_get_contents(app_path('models/files/TestModel2.php'));
$file3 = file_get_contents(app_path('models/files/TestModel3.php'));
$file4 = file_get_contents(app_path('models/files/Testmodel4.php'));

$I->openFile(app_path('models/all_model_test/TestModel.php'));
$I->seeFileContentsEqual($file1);

$I->openFile(app_path('models/all_model_test/TestModel2.php'));
$I->seeFileContentsEqual($file2);

$I->openFile(app_path('models/all_model_test/TestModel3.php'));
$I->seeFileContentsEqual($file3);

$I->openFile(app_path('models/all_model_test/Testmodel4.php'));
$I->seeFileContentsEqual($file4);

$I->deleteDir($modelsTestDir);
