<?php


namespace Nanaweb\GithubListenerBundle\Tests\Functional;


use Nanaweb\GithubListenerBundle\Listener\GithubListener;

class OperationRunnerPassTest extends KernelTestCase
{
    public function test()
    {
        static::bootKernel();

        /** @var GithubListener $listener */
        $listener = self::$container->get('nanaweb_github_listener.event_listener.pull_request');
        $refl = new \ReflectionObject($listener);
        $prop = $refl->getProperty('operationRunners');
        $prop->setAccessible(true);
        $runners = $prop->getValue($listener);

        $this->assertCount(1, $runners);
    }
}
