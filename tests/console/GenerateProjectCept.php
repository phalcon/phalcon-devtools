<?php

/**
 * This file is part of the Phalcon Developer Tools.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\DevTools\Tests\Console;

use Codeception\Scenario;
use ConsoleTester;

/**
 * @var Scenario $scenario
 */

$I = new ConsoleTester($scenario);
$I->wantToTest('Generating project');

$projectsFolder = 'projects';
chmod(app_path($projectsFolder), 0777);

$I->amInPath(app_path($projectsFolder));

/**
 * Case 1 - default path
 */
$projectName1 = 'project-tests1';
$path1 = $projectsFolder . '/' . $projectName1;
$foundFile1 = app_path($path1 . '/app/config/config.php');

$I->dontSeeFileFound($foundFile1);
$I->runShellCommand('phalcon project ' . $projectName1);
$I->seeFileFound(app_path($path1 . '/app/config/config.php'));
$I->deleteDir(app_path($path1));

/**
 * Case 2 - custom path
 */
$projectName2 = 'project-tests2';
$projectPath2 = 'project-tests2-custom';
$path2 = $projectsFolder . '/' . $projectPath2;
$foundFile2 = app_path($path2 . '/' . $projectName2 . '/app/config/config.php');

$I->dontSeeFileFound($foundFile2);
$I->runShellCommand("phalcon project $projectName2 simple $projectPath2");
$I->seeFileFound($foundFile2);
$I->deleteDir(app_path($path2));

/**
 * Case 3 - ini config file
 */
$projectName3 = 'project-tests3';
$path3 = $projectsFolder . '/' . $projectName3;
$foundFile3 = app_path($path3 . '/app/config/config.ini');

$I->dontSeeFileFound($foundFile3);
$I->runShellCommand('phalcon project ' . $projectName3 . ' --use-config-ini');
$I->seeFileFound($foundFile3);
$I->deleteDir(app_path($path3));

/**
 * Case 4 - custom template engine
 */
$projectName4 = 'hello_world';
$path4 = $projectsFolder . '/' . $projectName4;
$foundFile4 = app_path($path4 . '/app/views/index.volt');

$I->dontSeeFileFound($foundFile4);
$I->runShellCommand('phalcon project ' . $projectName4 . ' simple --template-engine=volt');
$I->seeFileFound($foundFile4);
$I->deleteDir(app_path($path4));

/**
 * Case 5 - Check webtools is disable by default
 */
$projectName5 = 'webtools_defaults';
$path5 = $projectsFolder . '/' . $projectName5;
$foundFile5 = app_path($path5 . '/public/webtools.php');
$foundFile5Config = app_path($path5 . '/public/webtools.php');

$I->dontSeeFileFound($foundFile5);
$I->dontSeeFileFound($foundFile5Config);
$I->runShellCommand('phalcon project ' . $projectName5);
$I->dontSeeFileFound($foundFile5);
$I->dontSeeFileFound($foundFile5Config);
$I->deleteDir(app_path($path5));

/**
 * Case 6 - Check webtools file when it's activated
 */
$projectName6 = 'webtools_activated';
$path6 = $projectsFolder . '/' . $projectName6;
$foundFile6 = app_path($path6 . '/public/webtools.php');
$foundFile6Config = app_path($path6 . '/public/webtools.config.php');

$I->dontSeeFileFound($foundFile6);
$I->dontSeeFileFound($foundFile6Config);
$I->runShellCommand('phalcon project ' . $projectName6 . ' --enable-webtools');
$I->seeFileFound($foundFile6);
$I->seeFileFound($foundFile6Config);
$I->deleteDir(app_path($path6));
