<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Repositories\PurchaseRepository;
use App\Repositories\UserRepository;

class PurchaseController extends Controller
{
    protected $purchaseRepository;

    protected $userRepository;

    public function __construct(PurchaseRepository $purchaseRepository, UserRepository $userRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $userId = auth()->id();
        $purchases = $this->purchaseRepository->all($userId);

        return response()->json($purchases);
    }

    public function store(PurchaseRequest $request)
    {
        $userId = auth()->id();
        $amount = $request->input("amount");
        $date = $request->input("date");
        $description = $request->input("description");

        $purchases = $this->purchaseRepository->store($userId, $amount, $date, $description);

        $this->userRepository->decreaseBalance($userId, $amount);

        return response()->json($purchases);
    }
}
