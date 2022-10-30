<?php

namespace App\Voter;

use App\Entity\User;
use App\Service\Authenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class IsAuthenticatedVoter extends Voter
{
    private Authenticator $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return 'IS_AUTHENTICATED_BY_TOKEN' === $attribute;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        return $this->authenticator->getAuthenticatedUser() instanceof User;
    }
}