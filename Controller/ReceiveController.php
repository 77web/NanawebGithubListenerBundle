<?php

namespace Nanaweb\GithubListenerBundle\Controller;

use Nanaweb\GithubListenerBundle\Event\GithubEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ReceiveController
 *
 * @Route("/github-listener")
 * @package Nanaweb\GithubListenerBundle\Controller
 */
class ReceiveController
{
    /**
     * @var EventDispatcher
     */
    private $eventDispatcher;

    /**
     * @param EventDispatcher $eventDispatcher
     */
    public function __construct(EventDispatcher $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @Route("/receive", name="nanaweb_github_listener_receive")
     * @param Request $request
     * @return Response
     */
    public function postAction(Request $request)
    {
        $eventName = $request->headers->get('X-GitHub-Event');
        $payload = json_decode($request->getContent(), true);

        $this->eventDispatcher->dispatch(new GithubEvent($eventName, $payload));

        return new Response();
    }
}
