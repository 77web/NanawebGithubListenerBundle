<?php


namespace Nanaweb\GithubListenerBundle\Security\User;


use Symfony\Component\Security\Core\User\UserInterface;

class GithubWebhook implements UserInterface
{
    /**
     * @var string
     */
    private $mySecret;

    /**
     * @param string $mySecret
     */
    public function __construct(string $mySecret)
    {
        $this->mySecret = $mySecret;
    }

    public function getRoles()
    {
        return [
            'ROLE_GITHUB_WEBHOOK'
        ];
    }

    public function getPassword()
    {
        return null;
    }

    public function getSalt()
    {
        return $this->mySecret;
    }

    public function getUsername()
    {
        return null;
    }

    public function eraseCredentials()
    {
        return null;
    }

    public function generateSignature(string $payload)
    {
        return sprintf('sha1=%s', hash_hmac('sha1', $payload, $this->mySecret));
    }
}
