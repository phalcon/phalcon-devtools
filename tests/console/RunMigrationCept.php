<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Running migration using migration file from .phalcon folder');

$I->amInPath(dirname(app_path()));
$I->cleanDir(tests_path('_data/console/.phalcon'));

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_many_running/migrations --table=test_many_running');
$I->seeInShellOutput('Success: Version 1.0.12 was successfully migrated');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_many_running/migrations --table=test_many_running --version=1.0.9');
$I->seeInShellOutput('Success: Version 1.0.10 was successfully rolled back');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_many_running/migrations --table=test_many_running --version=1.0.12');
$I->seeInShellOutput('Success: Version 1.0.12 was successfully migrated');

$I->cleanDir(tests_path('_data/console/.phalcon'));
