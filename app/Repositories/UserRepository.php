<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function find(string $userId)
    {
        return User::query()->findOrFail($userId);
    }

    public function getBalance(string $userId): float
    {
        return User::select("balance")->where("id", $userId)->value("balance") ?? 0;
    }

    public function increaseBalance(string $userId, float $balance): int
    {
        return User::query()->where('id', "=", $userId)->increment('balance', $balance);
    }

    public function decreaseBalance(string $userId, float $balance): int
    {
        return User::query()->where('id', "=", $userId)->decrement('balance', $balance);
    }
}
