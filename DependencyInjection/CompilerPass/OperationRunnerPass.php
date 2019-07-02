<?php


namespace Nanaweb\GithubListenerBundle\DependencyInjection\CompilerPass;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class OperationRunnerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        foreach ($container->findTaggedServiceIds('nanaweb_github_listener.operation_runner') as $operationRunnerId => $tags) {
            $operationRunnerDef = $container->getDefinition($operationRunnerId);
            foreach ($tags as $tag) {
                $eventName = $tag['event'];
                $listenerId = sprintf('nanaweb_github_listener.event_listener.%s', $eventName);
                if (!$eventName || !$container->hasDefinition($listenerId)) {
                    continue;
                }

                $container->getDefinition($listenerId)->addMethodCall('addOperationRunner', [$operationRunnerDef]);
            }
        }
    }

}
