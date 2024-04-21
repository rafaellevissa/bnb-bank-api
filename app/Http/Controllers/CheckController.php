<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckRequest;
use App\Repositories\CheckRepository;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    protected $checkRepository;

    public function __construct(CheckRepository $checkRepository)
    {
        $this->checkRepository = $checkRepository;
    }

    public function index()
    {
        $userId = auth()->id();
        $checks = $this->checkRepository->all($userId);

        return response()->json($checks);
    }

    public function find(string $checkId)
    {
        $userId = auth()->id();
        $check = $this->checkRepository->findOne($checkId, $userId);

        return response()->json($check);
    }

    public function store(CheckRequest $request)
    {
        $userId = auth()->id();
        $amount = $request->input("amount");
        $description = $request->input("description");
        $picture = $request->file('picture');

        $checks = $this->checkRepository->store($userId, $amount, $description, $picture);

        return response()->json($checks);
    }
}
