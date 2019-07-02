<?php

namespace Nanaweb\GithubListenerBundle\Tests\Functional;

use Nanaweb\GithubListenerBundle\Tests\Functional\KernelTestCase;

class GithubListenerTest extends KernelTestCase
{
    public function test()
    {
        static::bootKernel();

        $this->assertNotNull(self::$container->get('nanaweb_github_listener.event_listener.pull_request'));
    }
}
