<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function profile()
    {
        return view('me.profile', [
            'user' => Auth::user()
        ]);
    }

    public function edit()
    {
        return view('me.edit', [
            'user' => Auth::user()
        ]);
    }

//    public function update(Request $request)
//    {
//        $request->validate([
//            'name' => 'required|max:2',
//            'email' => 'required|unique:users|email'
//        ]);
//
//        return redirect()
//            ->route('me.profile')
//            ->with('status', 'Profil zaktualizowany');
//    }

    public function update(UpdateUserProfile $request)
    {

        $this->userRepository->updateModel(
            Auth::user(), $request->validated()
        );

        return redirect()
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');
    }

    public function updateValidationRules(Request $request)
    {
        $data = $request->validated();

        $request->validate([
            'name' => 'required|max:2',
            'email' => 'required|unique:users|email'
        ]);

        return redirect()
            ->route('me.profile')
            ->with('status', 'Profil zaktualizowany');
    }
}
