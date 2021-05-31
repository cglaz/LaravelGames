<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Faker\Factory;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function list(Request $request)
    {
        $users = [];

        $faker = Factory::create();
        $count = $faker->numberBetween(3, 15);
        for ($i = 0; $i < $count; $i++) {
            $users[] = [
                'id' => $faker->numberBetween(1, 1000),
                'name' => $faker->firstName
            ];
        }

        $session = $request->session();
        $session->put('prevAction', __METHOD__.' : '.time());


        $count = $faker->numberBetween(0,1);
        if ($count === 1) {
            $session->flash('Sukces', 'Operacja się powiodłaa');
        } else if ($count === 0) {
            $session->flash('Niepowodzenie', 'Sesja się nie powiodła');
        }

        //dump($request->session()->get('flashTestParam'));

        return view('user.list', [
            'users' => $users
        ]);
    }

    public function show(int $userId, Request $request)
    {

        $prevAction = $request->session()->get('prevAction');
        //$prevAction = $request->session()->get('prevAct', 'foo');
        dump($prevAction);

        //$request->session()->put('test_tt', null);
        $request->session()->put('test_tt', false);
//
//        dump($request->session()->has('test_tt'));
//        dump($request->session()->exists('test_tt'));

        //$request->session()->flush();

//        dump($request->session()->has('test_tt'));
//        dump($request->session()->exists('test_tt'));

        //dump($request->session()->all());



        $faker = Factory::create();
        $user = [
            'id' => $userId,
            'name' => $faker->name,
            'firstName' => $faker->firstName,
            'lastName' => $faker->lastName,
            'city' => $faker->city,
            'age' => $faker->numberBetween(12, 25),
            'html' => '<script>alert("XSS")</script>'
        ];

        return view('user.show', [
            'user' => $user,
            'nick' => true
        ]);
    }

    public function show_helper(int $userId, Request $request)
    {
        session(['test_tt' => 'hihih']);
        $prevAction = session('prevAction');
        //$prevAction = $request->session()->get('prevAct', 'foo');
        dump($prevAction);

        //$request->session()->put('test_tt', null);
        //$request->session()->put('test_tt', false);
//
//        dump($request->session()->has('test_tt'));
//        dump($request->session()->exists('test_tt'));

        //$request->session()->flush();

//        dump($request->session()->has('test_tt'));
//        dump($request->session()->exists('test_tt'));

        //dump($request->session()->all());



        $faker = Factory::create();
        $user = [
            'id' => $userId,
            'name' => $faker->name,
            'firstName' => $faker->firstName,
            'lastName' => $faker->lastName,
            'city' => $faker->city,
            'age' => $faker->numberBetween(12, 25),
            'html' => '<script>alert("XSS")</script>'
        ];

        return view('user.show', [
            'user' => $user,
            'nick' => true
        ]);
    }
}
