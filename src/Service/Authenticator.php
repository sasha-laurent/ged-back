<?php

namespace App\Service;

use App\ApiResource\LoginInput;
use App\Entity\AuthToken;
use App\Entity\User;
use App\Repository\AuthTokenRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class Authenticator
{
    private UserRepository $userRepository;
    private AuthTokenRepository $authTokenRepository;
    private RequestStack $requestStack;

    public function __construct(UserRepository $userRepository, AuthTokenRepository $authTokenRepository, RequestStack $requestStack)
    {
        $this->userRepository = $userRepository;
        $this->authTokenRepository = $authTokenRepository;
        $this->requestStack = $requestStack;
    }

    public function createToken(LoginInput $loginInput)
    {
        $authToken = $this->authTokenRepository->findOneBy(['username' => $loginInput->getUsername()]);

        if ($authToken) {
            return $authToken;
        }

        /** @var User $user */
        $user = $this->userRepository->findOneBy(['username' => $loginInput->getUsername()]);

        // todo : improve token ...
        $authToken = (new AuthToken())
            ->setUsername($user->getUsername())
            ->setToken($user->getId().'-'.uniqid());

        $this->authTokenRepository->save($authToken, true);

        return $authToken;
    }

    public function getAuthenticatedToken(): AuthToken|null
    {
        $token = $this->requestStack->getCurrentRequest()->headers->get('X-Custom-Auth');

        if (!$token) {
            return null;
        }

        return $this->authTokenRepository->findOneBy(['token' => $token]);
    }

    public function getAuthenticatedUser(): User|null
    {
        $authToken = $this->getAuthenticatedToken();

        if (!$authToken) {
            return null;
        }

        return $this->userRepository->findOneBy(['username' => $authToken->getUsername()]);
    }
}