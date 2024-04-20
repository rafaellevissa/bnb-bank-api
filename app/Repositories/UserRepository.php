<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getBalance(string $userId): float
    {
        return User::select("balance")->where("id", $userId)->value("balance") ?? 0;
    }
}
