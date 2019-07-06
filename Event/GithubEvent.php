<?php


namespace Nanaweb\GithubListenerBundle\Event;


class GithubEvent
{
    /**
     * @var string
     */
    private $eventName;

    /**
     * @var array
     */
    private $payload;

    /**
     * @param string $eventName
     * @param array $palyload
     */
    public function __construct(string $eventName, array $palyload)
    {
        $this->eventName = $eventName;
        $this->payload = $palyload;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->eventName;
    }

    /**
     * @return array
     */
    public function getPayload(): array
    {
        return $this->payload;
    }
}
