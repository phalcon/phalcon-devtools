<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('generating migration for MySQL database');

$output=<<<OUT
Success: Version 1.0.2 was successfully generated
OUT;

$I->amInPath(dirname(app_path()));

$I->deleteDir(app_path('migrations/1.0.2/'));
$I->dontSeeFileFound(app_path('migrations/1.0.2/test_migrations.php'));
$I->dontSeeFileFound(app_path('migrations/1.0.2/test_migrations.dat'));

$I->runShellCommand('phalcon migration --action=generate --migrations=app/migrations --table=test_migrations --data=always --config=app/mysql/config.php --log-in-db');

$I->seeInShellOutput($output);

$I->seeFileFound(app_path('migrations/1.0.2/test_migrations.php'));
$I->seeFileFound(app_path('migrations/1.0.2/test_migrations.dat'));
