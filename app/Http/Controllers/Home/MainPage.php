<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MainPage extends Controller
{
    public function __invoke()
    {
        return view('home.main');
    }
}
