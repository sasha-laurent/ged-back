<?php

namespace App\Controller;

use App\ApiResource\LoginInput;
use App\Service\Authenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginController extends AbstractController
{
    private Authenticator $authenticator;

    public function __construct(Authenticator $authenticator)
    {
        $this->authenticator = $authenticator;
    }

    public function __invoke(LoginInput $loginInput)
    {
        return $this->authenticator->createToken($loginInput);
    }
}