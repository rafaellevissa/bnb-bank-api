<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function increaseBalance(string $userId, Request $request)
    {
        $balance = $request->input("balance");

        $user = $this->userRepository->increaseBalance($userId, $balance);

        return response()->json($user);
    }

    public function decreaseBalance(string $userId, Request $request)
    {
        $balance = $request->input("balance");

        $user = $this->userRepository->decreaseBalance($userId, $balance);

        return response()->json($user);
    }
}
