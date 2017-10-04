<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);

$I->wantToTest('Generating migartion with --dry mode anf without');

$I->amInPath(dirname(app_path()));

$I->runShellCommand('phalcon migration --action=generate --migrations=app/test_dry_verbose/migrations --table=test_dry_verbose --config=app/mysql/config.php');
$I->seeInShellOutput('Success: Version 1.0.0 was successfully generated');
$I->seeFileFound(app_path('test_dry_verbose/migrations/1.0.0/test_dry_verbose.php'));

$I->runShellCommand('phalcon migration --action=generate --migrations=app/test_dry_verbose/migrations --table=test_dry_verbose --config=app/mysql/config.php');
$I->seeInShellOutput('Success: Version 1.0.1 was successfully generated');
$I->seeFileFound(app_path('test_dry_verbose/migrations/1.0.1/test_dry_verbose.php'));

$I->runShellCommand('phalcon migration --action=generate --migrations=app/test_dry_verbose/migrations --table=test_dry_verbose --config=app/mysql/config.php --dry');
$I->seeInShellOutput('DESCRIBE `devtools`.`test_dry_verbose`');
$I->dontSeeInShellOutput('Success: Version 1.0.2 was successfully generated');
$I->dontSeeFileFound(app_path('test_dry_verbose/migrations/1.0.2/test_dry_verbose.dat'));
