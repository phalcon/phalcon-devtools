<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);
$I->wantToTest('Generating scaffold');

$output=<<<OUT
Success: Scaffold was successfully created.
OUT;

$projectsFolder = 'projects';
$projectName = 'project-tests';
$path = $projectsFolder . '/' . $projectName;

$I->amInPath(app_path($projectsFolder));
$I->dontSeeFileFound(app_path($path));

$I->runShellCommand('phalcon project ' . $projectName);

$I->seeFileFound(app_path($path));
$I->deleteDir(app_path($path));
