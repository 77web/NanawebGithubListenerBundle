<?php

namespace Nanaweb\GithubListenerBundle\Tests\Functional;

use Nanaweb\GithubListenerBundle\NanawebGithubListenerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        return [
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new NanawebGithubListenerBundle()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config.yml');
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return __DIR__.'/logs';
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return __DIR__.'/cache';
    }
}
