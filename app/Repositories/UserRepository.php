<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function getBalance(string $userId): float
    {
        return User::select("balance")->where("id", $userId)->value("balance") ?? 0;
    }

    public function increaseBalance(string $userId, float $balance): int
    {
        return User::query()->where('user_id', "=", $userId)->increment('balance', $balance);
    }

    public function decreaseBalance(string $userId, float $balance): int
    {
        return User::query()->where('user_id', "=", $userId)->decrement('balance', $balance);
    }
}
