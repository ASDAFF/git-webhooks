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

use Citfact\GitWebHooks\WebHook\WebHookInterface;
use Symfony\Component\Process\Process;
use Psr\Log\LoggerInterface;

class Workflow implements WorkflowInterface
{
    /**
     * @var LoggerInterface|null
     */
    protected $logger;

    /**
     * @var WebHookInterface
     */
    protected $webHook;

    /**
     * @var DeployConfigInterface
     */
    protected $deploy;

    /**
     * @param LoggerInterface|null $logger
     * @param DeployConfigInterface $deploy
     * @param WebHookInterface $webHook
     */
    public function __construct(WebHookInterface $webHook, DeployConfigInterface $deploy, LoggerInterface $logger = null)
    {
        $this->logger = $logger;
        $this->webHook = $webHook;
        $this->deploy = $deploy;
    }

    /**
     * {@inheritdoc}
     */
    public function process()
    {
        $command = sprintf('cd %s', $this->deploy->getWorkDir());
        $scriptList = $this->deploy->getScript();

        if (!empty($scriptList)) {
            $command .= '&& '.implode(' && ', $scriptList);
        }

        $process = new Process($command);
        $process->run();

        if (!$process->isSuccessful()) {
            if ($this->logger) {
                $this->logger->warning(sprintf(
                    'Failed "%s" webhook. Repository name "%s". Output error: %s',
                    $this->webHook->getHostName(),
                    $this->webHook->getRepositoryName(),
                    $process->getErrorOutput()
                ));
            }

            return false;
        }

        if ($this->logger) {
            $this->logger->info(sprintf(
                'Successful update "%s" webhook. Repository name "%s"',
                $this->webHook->getHostName(),
                $this->webHook->getRepositoryName()
            ));
        }

        return true;
    }
}
