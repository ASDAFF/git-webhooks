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

interface DeployConfigInterface
{
    /**
     * @return string
     */
    public function getWorkDir();

    /**
     * @return array
     */
    public function getScript();

    /**
     * @return string
     */
    public function getRepositoryName();
}
