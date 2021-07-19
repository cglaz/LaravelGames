<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Faker\Factory;
use Illuminate\Http\Request;


class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function list()
    {
        $users = $this->userRepository->all();
        return view('user.list', ['users' => $users]);
    }

    public function show(int $userId)
    {
        $user = $this->userRepository->get($userId);
        return view('user.show', ['user' => $user]);
    }

}
