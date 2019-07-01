<?php

namespace Nanaweb\GithubListenerBundle\DependencyInjection;

use Nanaweb\GithubListenerBundle\Listener\GithubListener;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class NanawebGithubListenerExtension extends Extension
{
    private $githubEvents = [
        'check_run',
        'check_suite',
        'commit_comment',
        'content_reference',
        'create',
        'delete',
        'deploy_key',
        'deployment',
        'deployment_status',
        'fork',
        'github_app_authorization',
        'gollum',
        'installation',
        'installation_repositories',
        'issue_comment',
        'issues',
        'label',
        'marketplace_purchase',
        'member',
        'membership',
        'meta',
        'milestone',
        'organization',
        'org_block',
        'page_build',
        'project_card',
        'project_column',
        'project',
        'public',
        'pull_request',
        'pull_request_review',
        'pull_request_review_comment',
        'push',
        'registry_package',
        'release',
        'repository',
        'repository_import',
        'repository_vulnerability_alert',
        'security_advisory',
        'star',
        'status',
        'team',
        'team_add',
        'watch',
    ];

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');

        $this->loadGithubListeners($container);
    }

    private function loadGithubListeners(ContainerBuilder $container)
    {
        $githubListeners = [];
        foreach ($this->githubEvents as $eventName) {
            $definition = new Definition(GithubListener::class);
            $definition->addTag('kernel.event_listener', [
                'event' => sprintf('github.%s', $eventName),
                'method' => 'onGithubWebhook',
            ]);

            $githubListeners[] = $definition;
        }

        $container->addDefinitions($githubListeners);
    }
}
