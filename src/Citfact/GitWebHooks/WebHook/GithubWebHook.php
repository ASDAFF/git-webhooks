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

class GithubWebHook extends AbstractWebHook
{
    /**
     * {@inheritdoc}
     */
    public function getRepositoryName()
    {
        return $this->data['repository']['full_name'];
    }

    /**
     * {@inheritdoc}
     */
    public function getHostName()
    {
        return parse_url($this->data['repository']['html_url'], PHP_URL_HOST);
    }
}
