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
    private $palyload;

    /**
     * @param string $eventName
     * @param array $palyload
     */
    public function __construct(string $eventName, array $palyload)
    {
        $this->eventName = $eventName;
        $this->palyload = $palyload;
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
    public function getPalyload(): array
    {
        return $this->palyload;
    }
}
