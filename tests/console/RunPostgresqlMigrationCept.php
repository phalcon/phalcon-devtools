<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Running migration for Posqgresql database');

$I->amInPath(dirname(app_path()));
$I->cleanDir(tests_path('_data/console/.phalcon'));

$I->seeFileFound(app_path('test_insert_delete/migrations/1.0.3/test_insert_delete.php'));
$I->seeFileFound(app_path('test_insert_delete/migrations/1.0.3/test_insert_delete.dat'));

$I->runShellCommand('phalcon migration --action=run --config=app/postgresql/config.php --migrations=app/test_insert_delete/migrations/ --version=1.0.0');

$I->runShellCommand('phalcon migration --action=run --config=app/postgresql/config.php --migrations=app/test_insert_delete/migrations/ --version=1.0.1');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/postgresql/config.php --migrations=app/test_insert_delete/migrations/ --version=1.0.2');
$I->seeInShellOutput('Success: Version 1.0.2 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/postgresql/config.php --migrations=app/test_insert_delete/migrations/ --version=1.0.3');
$I->seeInShellOutput('Success: Version 1.0.3 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/postgresql/config.php --migrations=app/test_insert_delete/migrations/ --version=1.0.0');
$I->seeInShellOutput('Success: Version 1.0.3 was successfully rolled back');

$I->deleteDir(app_path('test_insert_delete/migrations/1.0.3/'));
$I->dontSeeFileFound(app_path('test_insert_delete/migrations/1.0.3/test_insert_delete.php'));
$I->dontSeeFileFound(app_path('test_insert_delete/migrations/1.0.3/test_insert_delete.dat'));
$I->cleanDir(tests_path('_data/console/.phalcon'));
