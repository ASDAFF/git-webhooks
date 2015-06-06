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

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Yaml\Yaml;

class DeployConfig implements DeployConfigInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $pathConfig;

    /**
     * @param string $pathConfig
     */
    public function __construct($fileConfig)
    {
        if (!file_exists($fileConfig)) {
            throw new \RuntimeException(sprintf('File "%s" could not be found', $fileConfig));
        }

        $config = Yaml::parse(file_get_contents($fileConfig));
        $this->pathConfig = dirname($fileConfig);

        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $this->config = $resolver->resolve($config);
    }

    /**
     * {@inheritdoc}
     */
    public function getWorkDir()
    {
        $dir = $this->config['work_dir'];
        if (!$this->isAbsolutePath($dir)) {
            $dir = realpath(sprintf('%s/%s', $this->pathConfig, $dir));
        }

        return $dir;
    }

    /**
     * {@inheritdoc}
     */
    public function getScript()
    {
        $script = $this->config['script'];

        return !is_array($script) ? array($script) : $script;
    }

    /**
     * {@inheritdoc}
     */
    public function getRepositoryName()
    {
        return $this->config['repo_name'];
    }

    /**
     * Returns whether the file path is an absolute path.
     *
     * @param string $file A file path
     *
     * @return bool
     */
    protected function isAbsolutePath($file)
    {
        return (strspn($file, '/\\', 0, 1)
            || (strlen($file) > 3 && ctype_alpha($file[0])
                && substr($file, 1, 1) === ':'
                && (strspn($file, '/\\', 2, 1))
            )
            || null !== parse_url($file, PHP_URL_SCHEME)
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('work_dir')
            ->setRequired('repo_name')
            ->setRequired('script');

        $resolver
            ->setAllowedTypes('work_dir', array('string'))
            ->setAllowedTypes('repo_name', array('string'))
            ->setAllowedTypes('script', array('array', 'string'));
    }
}
