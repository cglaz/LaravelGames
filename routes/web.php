<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    //USERS
    Route::get('/', 'Home\MainPage')
        ->name('home.mainPage');

    Route::get('users', 'UserController@list')
        ->name('get.users');

    Route::get('users/{userId}', 'UserController@show')
        ->name('get.user.show');


    Route::get('users/{id}/address', 'User\ShowAddress')
        ->where(['id' => '[0-9]+'])
        ->name('get.users.address');

//GAMES
    Route::group([
        'prefix' => 'b/games',
        'namespace' => 'Game',
        'as' => 'games.b.'
    ], function() {
        Route::get('dashboard','BuilderController@dashboard')
            ->name('dashboard');

        Route::get('', 'BuilderController@index')
            ->name('list')
            ->middleware(['paramCheck']);

        Route::get('{game}', 'BuilderController@show')
            ->name('show');
    });

    Route::group([
        'prefix' => 'e/games',
        'namespace' => 'Game',
        'as' => 'games.e.',
        //'middleware' => ['profiling']
    ], function() {
        Route::get('dashboard','EloquentController@dashboard')
            ->name('dashboard');

        Route::get('', 'EloquentController@index')
            ->name('list')
            ->middleware(['paramCheck']);

        Route::get('{game}', 'EloquentController@show')
            ->name('show')
            ->middleware(['profiling']);
    });

});

    Route::get('/auth/redirect', 'Auth\LoginController@redirectToGoogle')->name('login.google');

    Route::get('/auth/callback', 'Auth\LoginController@handleGoogleCallback');

    Route::get('/auth/login/facebook', 'Auth\LoginController@redirectToFacebook')->name('login.facebook');

    Route::get('/auth/callback/facebook', 'Auth\LoginController@handleFacebookCallback');

    Auth::routes();




