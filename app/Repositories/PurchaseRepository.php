<?php

namespace App\Repositories;

use App\Models\Purchase;
use DateTime;

class PurchaseRepository
{
    public function all(?string $userId = null)
    {
        if ($userId) {
            return Purchase::where("user_id", $userId)->get();
        }

        return Purchase::all();
    }

    public function store(string $userId, float $amount, string $date, string $description)
    {
        $dateTime = new DateTime($date);

        $formattedDate = $dateTime->format('Y-m-d');

        $purchase = Purchase::create([
            'user_id' => $userId,
            'amount' => $amount,
            'date' => $formattedDate,
            'description' => $description,
        ]);

        return $purchase;
    }
}
