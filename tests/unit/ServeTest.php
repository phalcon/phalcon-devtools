<?php

/*
  +------------------------------------------------------------------------+
  | Phalcon Developer Tools                                                |
  +------------------------------------------------------------------------+
  | Copyright (c) 2011-2017 Phalcon Team (https://www.phalconphp.com)      |
  +------------------------------------------------------------------------+
  | This source file is subject to the New BSD License that is bundled     |
  | with this package in the file LICENSE.txt.                             |
  |                                                                        |
  | If you did not receive a copy of the license and are unable to         |
  | obtain it through the world-wide-web, please send an email             |
  | to license@phalconphp.com so we can send you a copy immediately.       |
  +------------------------------------------------------------------------+
  | Authors: Paul Scarrone <paul@savvysoftworks.com>                       |
  +------------------------------------------------------------------------+
*/

use Phalcon\Commands\Builtin\Serve;
use Phalcon\Commands\CommandsListener;
use Phalcon\Script;
use Phalcon\Events\Manager as EventsManager;

class ServeTest extends \Codeception\Test\Unit
{
    protected $command = null;

    public function _before()
    {
        $eventsManager = new EventsManager();
        $eventsManager->attach('command', new CommandsListener());
        $script = new Script($eventsManager);
        $this->command = new Serve($script, $eventsManager);
        //$this->command->activateTestMode();
    }

    public function _after()
    {
        //$this->command->resetTestMode();
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testDefaultValuesWithNoParameters()
    {
        $_SERVER['argv'] = ['',''];
        $this->command->parseParameters([], []);
        $this->command->prepareOptions();
        $this->assertEquals('0.0.0.0', $this->command->getHostname());
        $this->assertEquals('8080', $this->command->getPort());
        $this->assertEquals('public/index.php', $this->command->getBasePath());
        $this->assertEmpty($this->command->getConfigPath());
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testGeneratedCommandWithNoParameters()
    {
        $_SERVER['argv'] = ['',''];
        $this->command->parseParameters([], []);
        $command = $this->command->shellCommand();
        $this->assertContains('php -S 0.0.0.0:8080 public/index.php', $command);
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration when only the
     * hostname is provided
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testDefaultValuesWithHostnameOnly()
    {
        $_SERVER['argv'] = ['','', 'localhost'];
        $this->command->parseParameters([], []);
        $this->command->prepareOptions();
        $this->assertEquals('localhost', $this->command->getHostname());
        $this->assertEquals('8080', $this->command->getPort());
        $this->assertEquals('public/index.php', $this->command->getBasePath());
        $this->assertEmpty($this->command->getConfigPath());
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration when only the
     * hostname is provided
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testGeneratedCommandWithHostnameOnly()
    {
        $_SERVER['argv'] = ['','', 'localhost'];
        $this->command->parseParameters([], []);
        $command = $this->command->shellCommand();
        $this->assertContains('php -S localhost:8080 public/index.php', $command);
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration when only the
     * port is provided
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testDefaultValuesWithPortOnly()
    {
        $_SERVER['argv'] = ['','', null, 1111];
        $this->command->parseParameters([], []);
        $this->command->prepareOptions();
        $this->assertEquals('0.0.0.0', $this->command->getHostname());
        $this->assertEquals('1111', $this->command->getPort());
        $this->assertEquals('public/index.php', $this->command->getBasePath());
        $this->assertEmpty($this->command->getConfigPath());
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration when only the
     * port is provided
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testGeneratedCommandWithPortOnly()
    {
        $_SERVER['argv'] = ['','', null, 1111];
        $this->command->parseParameters([], []);
        $command = $this->command->shellCommand();
        $this->assertContains('php -S 0.0.0.0:1111 public/index.php', $command);
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration when only the
     * basepath is provided
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testDefaultValuesWithBasepathOnly()
    {
        $_SERVER['argv'] = ['','', null, null, '/root/bin.php'];
        $this->command->parseParameters([], []);
        $this->command->prepareOptions();
        $this->assertEquals('0.0.0.0', $this->command->getHostname());
        $this->assertEquals('8080', $this->command->getPort());
        $this->assertEquals('/root/bin.php', $this->command->getBasePath());
        $this->assertEmpty($this->command->getConfigPath());
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration when only the
     * basepath is provided
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testGeneratedCommandWithBasepathOnly()
    {
        $_SERVER['argv'] = ['','', null, null, '/root/bin.php'];
        $this->command->parseParameters([], []);
        $command = $this->command->shellCommand();
        $this->assertContains('php -S 0.0.0.0:8080 /root/bin.php', $command);
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration when only the
     * config is provided
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testDefaultValuesWithConfigOnly()
    {
        $_SERVER['argv'] = ['','', null, null, null, '--config=awesome.ini'];
        $this->command->parseParameters([], []);
        $this->command->prepareOptions();
        $this->assertEquals('0.0.0.0', $this->command->getHostname());
        $this->assertEquals('8080', $this->command->getPort());
        $this->assertEquals('public/index.php', $this->command->getBasePath());
        $this->assertEquals('-c awesome.ini', $this->command->getConfigPath());
    }

    /**
     * Verify that is no arguments are passed via the command line
     * this will provide a valid default configuration when only the
     * config is provided
     *
     * @author Paul Scarrone <paul@savvysoftworks.com>
     */
    public function testGeneratedCommandWithConfigOnly()
    {
        $_SERVER['argv'] = ['','', null, null, null, '--config=awesome.ini'];
        $this->command->parseParameters([], []);
        $command = $this->command->shellCommand();
        $this->assertContains('php -S 0.0.0.0:8080 public/index.php -c awesome.ini', $command);
    }
}
