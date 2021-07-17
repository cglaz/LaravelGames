<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

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
//Route::group(['middleware' => ['auth']], function() {
Route::middleware(['auth'])->group(function() {
    Route::get('/', 'Home\MainPage')
    ->name('home.mainPage');

    //USER - ME

    Route::group(['prefix' => 'me', 'as' => 'me.'], function() {
        Route::get('profile', 'User\UserController@profile')
            ->name('profile');

        Route::get('edit', 'User\UserController@edit')
            ->name('edit');

        Route::post('update', 'User\UserController@update')
            ->name('update');

        Route::delete('deletephoto', 'User\UserController@deletePhoto')
            ->name('delete.photo');
    });

    // USERS
    Route::get('users', 'UserController@list')
        ->name('get.users');

    Route::get('users/{userId}', 'UserController@show')
        ->name('get.user.show');

    Route::get('users/{id}/address', 'User\ShowAddress')
        ->where(['id' => '[0-9]+'])
        ->name('get.users.address');

    // GAMES
    Route::group([
        'prefix' => 'games',
        'namespace' => 'Game',
        'as' => 'games.'
    ], function () {
        Route::get('dashboard', 'GameController@dashboard')
            ->name('dashboard');

        Route::get('', 'GameController@index')
            ->name('list');

        Route::get('{game}', 'GameController@show')
            ->name('show');
    });

});

Auth::routes();
