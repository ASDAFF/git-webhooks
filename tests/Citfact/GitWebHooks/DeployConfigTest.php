<?php

/*
 * This file is part of the Studio Fact package.
 *
 * (c) Kulichkin Denis (onEXHovia) <onexhovia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Citfact\GitWebHooks;

class DeployConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testGetWorkDir()
    {
        $fixturesDir = __DIR__.'/Fixtures';

        $deploy = new DeployConfig($fixturesDir.'/webhook_1.yml');
        $this->assertEquals($fixturesDir, $deploy->getWorkDir());

        $deploy = new DeployConfig($fixturesDir.'/webhook_2.yml');
        $this->assertEquals('/var/www/html', $deploy->getWorkDir());
    }

    public function testGetRepositoriesName()
    {
        $fixturesDir = __DIR__.'/Fixtures';

        $deploy = new DeployConfig($fixturesDir.'/webhook_1.yml');
        $this->assertEquals('studiofact/git-webhooks', $deploy->getRepositoryName());
    }

    public function testGetScripts()
    {
        $fixturesDir = __DIR__.'/Fixtures';

        $deploy = new DeployConfig($fixturesDir.'/webhook_1.yml');
        $this->assertCount(2, $deploy->getScript());

        $deploy = new DeployConfig($fixturesDir.'/webhook_2.yml');
        $this->assertCount(1, $deploy->getScript());
    }
}
