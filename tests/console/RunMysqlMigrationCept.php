<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Running migration for MySQL database');

$output=<<<OUT
Success: Version 1.0.1 was successfully migrated
OUT;

$I->amInPath(dirname(app_path()));

$I->seeFileFound(app_path('migrations/1.0.1/test_migrations.php'));
$I->seeFileFound(app_path('migrations/1.0.1/test_migrations.dat'));

$I->runShellCommand('phalcon migration --action=run --version=1.0.0');
$I->runShellCommand('phalcon migration --action=run --version=1.0.1');
$I->runShellCommand('phalcon migration --action=run --version=1.0.0');
$I->runShellCommand('phalcon migration --action=run --version=1.0.1');

$I->seeInShellOutput($output);

$I->deleteDir(app_path('migrations/1.0.1/'));

$I->dontSeeFileFound(app_path('migrations/1.0.1/test_migrations.php'));
$I->dontSeeFileFound(app_path('migrations/1.0.1/test_migrations.dat'));
