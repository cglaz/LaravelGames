<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MainPage extends Controller
{
    //public function __invoke()
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        //$user = $request->user();
        $id = Auth::id();

//
//        if(Auth::check()) {
//
//        }
//Auth::logout();

        return view('home.main', ['user' => $user,]);
    }
}
