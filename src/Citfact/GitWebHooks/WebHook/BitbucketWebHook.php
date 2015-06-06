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

class BitbucketWebHook extends AbstractWebHook
{
    /**
     * {@inheritdoc}
     */
    public function getRepositoryName()
    {
        $repositoryName = pathinfo(substr($this->data['repository']['absolute_url'], 1));

        return sprintf('%s/%s', $repositoryName['dirname'], $repositoryName['basename']);
    }

    /**
     * {@inheritdoc}
     */
    public function getHostName()
    {
        return parse_url($this->data['canon_url'], PHP_URL_HOST);
    }
}
