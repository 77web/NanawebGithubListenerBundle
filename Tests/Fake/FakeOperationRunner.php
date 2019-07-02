<?php


namespace Nanaweb\GithubListenerBundle\Tests\Fake;


use Nanaweb\GithubListenerBundle\Event\GithubEvent;
use Nanaweb\GithubListenerBundle\Operation\OperationRunnerInterface;

class FakeOperationRunner implements OperationRunnerInterface
{
    public function run(GithubEvent $event)
    {
        // do nothing
    }
}
