<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Running migration with --verbose mode and without');

$I->amInPath(dirname(app_path()));
$I->cleanDir(tests_path('_data/console/.phalcon'));

$I->seeFileFound(app_path('test_dry_verbose/migrations/1.0.0/test_dry_verbose.php'));
$I->seeFileFound(app_path('test_dry_verbose/migrations/1.0.1/test_dry_verbose.php'));

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_dry_verbose/migrations/ --version=1.0.0');
$I->seeInShellOutput('Success: Version 1.0.0 was successfully migrated');
$I->dontSeeInShellOutput('DESCRIBE `devtools`.`test_dry_verbose`');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_dry_verbose/migrations/ --version=1.0.1');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully migrated');
$I->dontSeeInShellOutput('DESCRIBE `devtools`.`test_dry_verbose`');

$I->runShellCommand('phalcon migration --action=run --config=app/mysql/config.php --migrations=app/test_dry_verbose/migrations/ --version=1.0.0 --verbose');
$I->seeInShellOutput('DESCRIBE `devtools`.`test_dry_verbose`');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully rolled back');

$I->cleanDir(tests_path('_data/console/.phalcon'));
$I->deleteDir(app_path('test_dry_verbose'));
