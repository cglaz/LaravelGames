<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Model\User;
use App\Repository\UserRepository;
use Faker\Factory;
use Illuminate\Support\Facades\Gate;
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
//
//        if (Gate::denies('admin-level', true)) {
//                abort(403);
//        }
//        try {
//            Gate::authorize('admin-level');
//        } catch (\Throwable $exception) {
//            dd($exception);
//        }

//        $respone = Gate::inspect('admin-level');
//
//        if (! $respone->allowed()) {
//            echo $respone->message();
//            dd('exit');
//        }

        Gate::authorize('admin-level');

        $users = $this->userRepository->all();
        return view('user.list', ['users' => $users]);
    }

    public function show(Request $request, int $userId)
    {
        //$user = $request->user();

        //Gate::authorize('admin-level');
        //if (! $user->can('admin-level')) {
//        if ( $user->cannot('admin-level')) {
//            abort(403);
//        }
        $this->authorize('admin-level');

        $userModel = $this->userRepository->get($userId);


        //Gate::authorize('view', $userModel);
//        if ($user->cannot('create', User::class)) {
//            dd('d');
//           abort(403);
//        }
        $this->authorize('view', $userModel);

        $user = $this->userRepository->get($userId);
        return view('user.show', ['user' => $user]);
    }

}
