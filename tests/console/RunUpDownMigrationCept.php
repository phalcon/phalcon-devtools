<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Running migration with different situations and without migration');

$I->amInPath(dirname(app_path()));
$I->cleanDir(tests_path('_data/console/.phalcon'));

$I->copyDir('app/test_many_running', 'app/test_up_down');
$I->seeFileFound(app_path('test_up_down/migrations/1.0.12/test_many_running.php'));

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.0');
$I->seeInShellOutput('Success: Version 1.0.0 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.1');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.0');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully rolled back');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.5');
$I->seeInShellOutput('Success: Version 1.0.5 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.0');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully rolled back');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.5');
$I->seeInShellOutput('Success: Version 1.0.5 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.12');
$I->seeInShellOutput('Success: Version 1.0.12 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.0');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully rolled back');

$I->cleanDir(app_path('test_up_down/migrations'));

$I->dontSeeFileFound(app_path('test_up_down/migrations/1.0.0/test_many_running.php'));
$I->dontSeeFileFound(app_path('test_up_down/migrations/1.0.12/test_many_running.php'));


$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_up_down/migrations --table=test_many_running --version=1.0.0');
$I->seeInShellOutput('Phalcon DevTools');

$I->cleanDir(tests_path('_data/console/.phalcon'));
