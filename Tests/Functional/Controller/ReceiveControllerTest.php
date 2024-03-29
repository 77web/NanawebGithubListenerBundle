<?php


namespace Nanaweb\GithubListenerBundle\Tests\Functional\Controller;


use Nanaweb\GithubListenerBundle\Event\GithubEvent;
use Nanaweb\GithubListenerBundle\Tests\Functional\KernelTestCase;

class ReceiveControllerTest extends KernelTestCase
{
    public function test_receive()
    {
        static::bootKernel();
        $client = self::$container->get('test.client');
        $client->getContainer()->get('event_dispatcher')->addListener('github.foo', function(GithubEvent $event){
            $this->assertEquals('github.foo', $event->getEventName());
            $this->assertEquals(['test' => true], $event->getPayload());
        });
        $client->request('POST', '/github-listener/receive', [], [], [
            'HTTP_X_GITHUB_EVENT' => 'foo',
        ], json_encode(['test' => true]));

        $response = $client->getResponse();
        $this->assertTrue($response->isOk(), $response->getStatusCode());
    }
}
