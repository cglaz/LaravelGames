<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GameController extends Controller
{
    // CRUD
    // C - create
    // R - read
    // U - update
    // D - delete


    public function index(): View
    {
        $games = DB::table('games')
            ->select('id', 'title', 'score', 'genre_id')
            ->get();

        return view('games.list', [
            'games' => $games
        ]);
    }


    public function create(): Response
    {
        //
    }


    public function store(Request $request): Response
    {
        //
    }


    public function show(int $gameId): View
    {
        $gamesTable = DB::table('games');
        //$games = $gamesTable->select('id','title', 'score', 'gnere_id')->where('id', $gameId)->get();
        //$game = $gamesTable->where('id', $gameId)->first();
        $game = $gamesTable->find($gameId);

        return view('games.show', [
            'game' => $game
        ]);
    }


    public function edit(int $id): Response
    {
        //
    }


    public function update(Request $request, int $id): Response
    {
        //
    }


    public function destroy(int $id): Response
    {
        //
    }
}
