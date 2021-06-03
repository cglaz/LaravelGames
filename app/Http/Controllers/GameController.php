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
        $stats = [
            'count' => DB::table('games')->count(),
            'countScoreGtSeven' => DB::table('games')->where('score', '>', 7)->count(),
            'max' => DB::table('games')->max('score'),
            'min' => DB::table('games')->min('score'),
            'avg' => DB::table('games')->avg('score')
        ];

        return view('games.list', [
            'games' => $games,
            'stats' => $stats
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
