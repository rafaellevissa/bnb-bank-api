<?php

namespace App\Http\Controllers;

use App\Repositories\CheckRepository;
use Illuminate\Http\Request;

class AdminCheckController extends Controller
{
    protected $checkRepository;

    public function __construct(CheckRepository $checkRepository)
    {
        $this->checkRepository = $checkRepository;
    }

    public function index()
    {
        $checks = $this->checkRepository->findByStatus("pending");

        return response()->json($checks);
    }

    public function find(string $checkId)
    {
        $check = $this->checkRepository->findOne($checkId, null, "pending");

        return response()->json($check);
    }

    public function update(string $checkId, Request $request)
    {
        $paylaod = $request->post();
        $check = $this->checkRepository->update($checkId, $paylaod);

        return response()->json($check);
    }
}
