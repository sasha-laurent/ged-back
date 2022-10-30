<?php

namespace App\ApiResource;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Controller\LoginController;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: 'login',
            controller: LoginController::class,
            name: 'api_login'
        )
    ]

)]
class LoginInput
{
    private string $username;
    private string $password;

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
}