<?php


namespace Nanaweb\GithubListenerBundle\Listener;


use Nanaweb\GithubListenerBundle\Event\GithubEvent;
use Nanaweb\GithubListenerBundle\Operation\OperationRunnerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GithubListener
{
    /**
     * @var OperationRunnerInterface[]
     */
    private $operationRunners = [];

    public function addOperationRunner(OperationRunnerInterface $operationRunner)
    {
        $this->operationRunners[] = $operationRunner;
    }

    public function onGithubWebhook(GithubEvent $event)
    {
        foreach ($this->operationRunners as $runner) {
            $runner->run($event);
        }
    }
}
