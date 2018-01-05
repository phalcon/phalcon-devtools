<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Running migration for MySQL database');

$I->amInPath(dirname(app_path()));
$I->cleanDir(tests_path('_data/console/.phalcon'));
$I->copyDir(tests_path('_data/console_data/run_mysql_migration/1.0.2/'), app_path('migrations/1.0.2'));

$I->seeFileFound(app_path('migrations/1.0.2/test_migrations.php'));
$I->seeFileFound(app_path('migrations/1.0.2/test_migrations.dat'));

$I->runShellCommand('phalcon migration --action=run --version=1.0.2');

$I->runShellCommand('phalcon migration --action=run --version=1.0.1');
$I->seeInShellOutput('Success: Version 1.0.2 was successfully rolled back');

$I->runShellCommand('phalcon migration --action=run --version=1.0.0');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully rolled back');

$I->runShellCommand('phalcon migration --action=run --version=1.0.1');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --version=1.0.2');
$I->seeInShellOutput('Success: Version 1.0.2 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --version=1.0.0');

$I->deleteDir(app_path('migrations/1.0.2/'));

$I->dontSeeFileFound(app_path('migrations/1.0.2/test_migrations.php'));
$I->dontSeeFileFound(app_path('migrations/1.0.2/test_migrations.dat'));
$I->cleanDir(tests_path('_data/console/.phalcon'));
