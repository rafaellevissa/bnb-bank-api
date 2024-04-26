<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    protected function calculateIncomingAmount(Collection $transactions): float
    {
        return $transactions->where('type', 'incoming')->sum('amount');
    }

    protected function calculateOutcomingAmount(Collection $transactions): float
    {
        return $transactions->where('type', 'outcoming')->sum('amount');
    }

    public function all(?int $userId = null): Collection
    {
        $checks = User::select('users.id', 'checks.*', DB::raw("'incoming' as type"))
            ->where('checks.status', 'accepted')
            ->join('checks', 'users.id', '=', 'checks.user_id');


        $purchases = User::select('users.id', 'purchases.*', DB::raw("'outcoming' as type"))
            ->join('purchases', 'users.id', '=', 'purchases.user_id');

        if ($userId !== null) {
            $checks->where('users.id', $userId);
            $purchases->where('users.id', $userId);
        }

        $checksResult = $checks->get();
        $purchasesResult = $purchases->get();

        $transactions = collect($checksResult)->merge($purchasesResult)->sortBy('created_at')->values();

        return collect([
            'transactions' => $transactions->toArray(),
            'incomingAmount' => $this->calculateIncomingAmount($transactions),
            'outcomingAmount' => $this->calculateOutcomingAmount($transactions),
        ]);
    }
}
