<?php

/*
 * This file is part of the Studio Fact package.
 *
 * (c) Kulichkin Denis (onEXHovia) <onexhovia@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Citfact\GitWebHooks\WebHook;

class GithubWebHookTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var GithubWebHook
     */
    protected $webHook;

    protected function setUp()
    {
        $this->webHook = new GithubWebHook(array(
            'repository' => array(
                'id' => 36976534,
                'name' => 'webhook',
                'full_name' => 'onEXHovia/webhook',
                'html_url' => 'https://github.com/onEXHovia',
            ),
        ));
    }

    public function testGetRepositoryName()
    {
        $this->assertEquals('onEXHovia/webhook', $this->webHook->getRepositoryName());
    }

    public function testGetHostName()
    {
        $this->assertEquals('github.com', $this->webHook->getHostName());
    }
}
