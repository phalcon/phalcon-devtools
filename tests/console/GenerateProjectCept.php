<?php

/**
 * @var Codeception\Scenario $scenario
 */

$I = new ConsoleTester($scenario);
$I->wantToTest('Generating project');

$output=<<<OUT
Success: Project was successfully created.
OUT;

$projectsFolder = 'projects';
chmod(app_path($projectsFolder), 0777);

$I->amInPath(app_path($projectsFolder));

/**
 * Case 1 - default path
 */
$projectName1 = 'project-tests1';
$path1 = $projectsFolder . '/' . $projectName1;

$I->dontSeeFileFound(app_path($path1));
$I->runShellCommand('phalcon project ' . $projectName1);
$I->seeFileFound(app_path($path1));
$I->deleteDir(app_path($path1));

/**
 * Case 2 - custom path
 */
$projectName2 = 'project-tests2';
$projectPath2 = 'project-tests2-custom';
$path2 = $projectsFolder . '/' . $projectPath2;

$I->dontSeeFileFound(app_path($path2));
$I->runShellCommand("phalcon project $projectName2 simple $projectPath2");
$I->seeFileFound(app_path($path2));
$I->deleteDir(app_path($path2));
