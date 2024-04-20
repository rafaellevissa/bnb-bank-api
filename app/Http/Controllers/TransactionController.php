<?php

namespace App\Http\Controllers;

use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class TransactionController extends Controller
{
    protected $transactionRepository;
    protected $userRepository;

    public function __construct(TransactionRepository $transactionRepository, UserRepository $userRepository,)
    {
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $userId = 1;
        $transactions = $this->transactionRepository->all($userId);
        $balance = $this->userRepository->getBalance($userId);

        $transactions->put('balance', $balance);

        return response()->json($transactions);
    }
}
