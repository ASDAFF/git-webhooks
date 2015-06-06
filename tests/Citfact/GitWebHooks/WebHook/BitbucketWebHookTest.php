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

class BitbucketWebHookTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BitbucketWebHook
     */
    protected $webHook;

    protected function setUp()
    {
        $this->webHook = new BitbucketWebHook(array(
            'repository' => array(
                'website' => '',
                'fork' => '',
                'name' => 'webhook',
                'scm' => 'git',
                'owner' => 'onEXHovia',
                'absolute_url' => '/onEXHovia/webhook/',
                'slug' => 'webhook',
                'is_private' => 1,
            ),
            'canon_url' => 'https://bitbucket.org',
        ));
    }

    public function testGetRepositoryName()
    {
        $this->assertEquals('onEXHovia/webhook', $this->webHook->getRepositoryName());
    }

    public function testGetHostName()
    {
        $this->assertEquals('bitbucket.org', $this->webHook->getHostName());
    }
}
