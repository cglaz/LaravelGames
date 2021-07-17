<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserProfile;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
        $user = Auth::user();
        $userId = Auth::id();
        $data = $request->validated();
        $path = null;


        if (!empty($data['avatar'])) {
            //$path = $data['avatar']->store('avatars', 'public');
            $path = $data['avatar']->storeAs('avatars',Auth::id().'.png', 'public');

            if ($path) {
                Storage::disk('public')->delete(Auth::id().'.png');
                $data['avatar'] = $path;
            }
        }

        if ($request->has('deletephoto')) {
            $data['avatar'] = null;
        }

        if (!array_key_exists('avatar', $data)) {
            $data['avatar'] = 'avatars/'.$userId.'.png';
        }


        $this->userRepository->updateModel(Auth::user(), $data);

        return redirect()
            ->route('me.profile')
            ->with('success', 'Profil zaktualizowany');
    }

    public function deletePhoto(UpdateUserProfile $request) {
        dd($request);
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
            ->with('success', 'Profil zaktualizowany');
    }
}
