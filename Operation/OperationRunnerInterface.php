<?php


namespace Nanaweb\GithubListenerBundle\Operation;


use Nanaweb\GithubListenerBundle\Event\GithubEvent;

interface OperationRunnerInterface
{
    public function run(GithubEvent $event);
}
