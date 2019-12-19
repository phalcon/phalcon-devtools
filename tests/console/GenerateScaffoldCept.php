<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Generating scaffold');

$output=<<<OUT
Success: Scaffold was successfully created.
OUT;

$I->amInPath(dirname(app_path()));
$I->dontSeeFileFound(app_path('controllers/GenscaffoldController.php'));
$I->dontSeeFileFound(app_path('models/Genscaffold.php'));
$I->dontSeeFileFound(app_path('views/layouts/genscaffold.phtml'));
$I->dontSeeFileFound(app_path('views/genscaffold/edit.phtml'));
$I->dontSeeFileFound(app_path('views/genscaffold/index.phtml'));
$I->dontSeeFileFound(app_path('views/genscaffold/new.phtml'));
$I->dontSeeFileFound(app_path('views/genscaffold/search.phtml'));

$I->runShellCommand('phalcon scaffold genScaffold --get-set --config=app/mysql/config.php');

$I->seeInShellOutput($output);

$scaffoldControllerPath = app_path('controllers/GenscaffoldController.php');
$scaffoldModelPath = app_path('models/Genscaffold.php');

$I->seeFileFound($scaffoldControllerPath);
$I->seeFileFound($scaffoldModelPath);
$I->seeFileFound(app_path('views/layouts/genscaffold.phtml'));
$I->seeFileFound(app_path('views/genscaffold/edit.phtml'));
$I->seeFileFound(app_path('views/genscaffold/index.phtml'));
$I->seeFileFound(app_path('views/genscaffold/new.phtml'));
$I->seeFileFound(app_path('views/genscaffold/search.phtml'));

$I->openFile($scaffoldControllerPath);
$I->dontSeeInThisFile('namespace ;');

$I->openFile($scaffoldModelPath);
$I->dontSeeInThisFile('namespace ;');

$I->deleteDir(app_path('views/layouts/'));
$I->deleteDir(app_path('views/genscaffold/'));
$I->deleteFile($scaffoldModelPath);
$I->deleteFile($scaffoldControllerPath);
