<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Generating migration for testing table prefix');

$I->amInPath(dirname(app_path()));

$I->dontSeeFileFound(app_path('test_table_prefix/migrations/1.0.1/issue595_1.php'));
$I->dontSeeFileFound(app_path('test_table_prefix/migrations/1.0.1/issue595_2.php'));

$I->runShellCommand('phalcon migration --action=generate --config=app/mysql/config.php --migrations=app/test_table_prefix/migrations --table=issue595*');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully generated');

$I->seeFileFound(app_path('test_table_prefix/migrations/1.0.1/issue595_1.php'));
$I->seeFileFound(app_path('test_table_prefix/migrations/1.0.1/issue595_2.php'));
