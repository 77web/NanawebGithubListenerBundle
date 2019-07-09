<?php


namespace Nanaweb\GithubListenerBundle\Security\Guard;


use Nanaweb\GithubListenerBundle\Security\User\GithubWebhook;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class GithubWebhookAuthenticator extends AbstractGuardAuthenticator
{
    const TARGET_HEADER = 'X-Hub-Signature';

    /**
     * @var string
     */
    private $myGithubSecret;

    /**
     * @param string $myGithubSecret
     */
    public function __construct(string $myGithubSecret)
    {
        $this->myGithubSecret = $myGithubSecret;
    }

    public function supports(Request $request)
    {
        return $request->headers->has(self::TARGET_HEADER) && $request->getContent() !== null;
    }

    public function getCredentials(Request $request)
    {
        return [
            'signature' => $request->headers->get(self::TARGET_HEADER),
            'payload' => $request->getContent(),
        ];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        return new GithubWebhook($this->myGithubSecret);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        $signature = $credentials['signature'];
        $payload = $credentials['payload'];
        if (null === $signature || $payload === null) {
            return false;
        }

        /** @var GithubWebhook $user */
        return hash_equals($user->generateSignature($payload), $signature);
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        return new Response(Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return;
    }

    public function supportsRememberMe()
    {
        return false;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new Response(Response::HTTP_UNAUTHORIZED);
    }
}
