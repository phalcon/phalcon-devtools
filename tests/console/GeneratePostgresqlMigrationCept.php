<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Generating migration for Postgresql database');

$output=<<<OUT
Success: Version 1.0.3 was successfully generated
OUT;

$I->amInPath(dirname(app_path()));

$I->deleteDir(app_path('test_insert_delete/migrations/1.0.3/'));
$I->dontSeeFileFound(app_path('test_insert_delete/migrations/1.0.3/test_insert_delete.php'));
$I->dontSeeFileFound(app_path('test_insert_delete/migrations/1.0.3/test_insert_delete.dat'));

$I->runShellCommand('phalcon migration --action=generate --migrations=app/test_insert_delete/migrations --table=test_insert_delete --data=always --config=app/postgresql/config.php');

$I->seeInShellOutput($output);

$I->seeFileFound(app_path('test_insert_delete/migrations/1.0.3/test_insert_delete.php'));
$I->seeFileFound(app_path('test_insert_delete/migrations/1.0.3/test_insert_delete.dat'));
