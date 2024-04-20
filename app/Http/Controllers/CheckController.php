<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckRequest;
use App\Repositories\CheckRepository;

class CheckController extends Controller
{
    protected $checkRepository;

    public function __construct(CheckRepository $checkRepository)
    {
        $this->checkRepository = $checkRepository;
    }

    public function index()
    {
        $userId = 1;
        $checks = $this->checkRepository->all($userId);

        return response()->json($checks);
    }

    public function store(CheckRequest $request)
    {
        $userId = 1;
        $amount = $request->input("amount");
        $description = $request->input("description");
        $picture = $request->file('picture');

        $checks = $this->checkRepository->store($userId, $amount, $description, $picture);

        return response()->json($checks);
    }
}
