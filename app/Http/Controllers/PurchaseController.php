<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Repositories\PurchaseRepository;

class PurchaseController extends Controller
{
    protected $purchaseRepository;

    public function __construct(PurchaseRepository $purchaseRepository)
    {
        $this->purchaseRepository = $purchaseRepository;
    }

    public function index()
    {
        $userId = 1;
        $purchases = $this->purchaseRepository->all($userId);

        return response()->json($purchases);
    }

    public function store(PurchaseRequest $request)
    {
        $userId = 1;
        $amount = $request->input("amount");
        $date = $request->input("date");
        $description = $request->input("description");


        $purchases = $this->purchaseRepository->store($userId, $amount, $date, $description);

        return response()->json($purchases);
    }
}