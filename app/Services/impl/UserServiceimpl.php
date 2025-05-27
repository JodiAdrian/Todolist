<?php

namespace App\Services\impl;

use App\Services\UserService;

class UserServiceimpl implements UserService
{
    private array $users = [
        "jodi" => "rahasia"
    ];
    function login(string $user, string $password): bool
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password. $correctPassword;
    }
}
