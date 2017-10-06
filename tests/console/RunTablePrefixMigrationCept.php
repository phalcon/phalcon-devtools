<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Running migration for testing table prefix');

$I->amInPath(dirname(app_path()));
$I->cleanDir(tests_path('_data/console/.phalcon'));

$I->seeFileFound(app_path('test_table_prefix/migrations/1.0.1/issue595_1.php'));
$I->seeFileFound(app_path('test_table_prefix/migrations/1.0.1/issue595_2.php'));

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_table_prefix/migrations/ --version=1.0.0 --table=issue595*');
$I->seeInShellOutput('Success: Version 1.0.0 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_table_prefix/migrations/ --version=1.0.1 --table=issue595*');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully migrated');

$I->deleteDir(app_path('test_table_prefix/migrations/1.0.1/'));
$I->dontSeeFileFound(app_path('test_table_prefix/migrations/1.0.1/issue595_1.php'));
$I->dontSeeFileFound(app_path('test_table_prefix/migrations/1.0.1/issue595_2.php'));
$I->cleanDir(tests_path('_data/console/.phalcon'));
