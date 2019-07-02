<?php

namespace Nanaweb\GithubListenerBundle;

use Nanaweb\GithubListenerBundle\DependencyInjection\CompilerPass\OperationRunnerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NanawebGithubListenerBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new OperationRunnerPass());
    }
}
