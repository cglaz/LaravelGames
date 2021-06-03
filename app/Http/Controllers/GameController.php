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
//        $games = DB::table('games')
//            ->select('id', 'title', 'score', 'genre_id')
//            ->get();

        $games = DB::table('games')
            ->join('genres', 'games.genre_id', '=', 'genres.id')
            ->select('games.id', 'games.title', 'games.score', 'genres.name as genre_name')
            ->get();

        $bestGames = DB::table('games')
            ->join('genres', 'games.genre_id', '=', 'genres.id')
            ->select('games.id', 'games.title', 'games.score', 'genres.name as genre_name')
            ->where('score', '>', 9)
            ->get();

//        $query = DB::table('games')
//            ->select('id', 'title', 'score', 'genre_id')
//            ->where([
//                ['score', '>', 5],
//                ['id', '>', 44]
//            ]);

//        $query = DB::table('games')
//            ->select('id', 'title', 'score', 'genre_id')
//            ->where('score', '>', '6')
//            ->orWhere('id', 55);

//        $query = DB::table('games')
//            ->select('id', 'title', 'score', 'genre_id')
//            ->whereIn('id', [22, 44, 23, 55]);

//        $query = DB::table('games')
//            ->select('id', 'title', 'score', 'genre_id')
//            ->whereBetween('id', [22, 25]);
//
//        dump($query->get());
//        dump($query->toSql());

        $stats = [
            'count' => DB::table('games')->count(),
            'countScoreGtSeven' => DB::table('games')->where('score', '>', 7)->count(),
            'max' => DB::table('games')->max('score'),
            'min' => DB::table('games')->min('score'),
            'avg' => DB::table('games')->avg('score')
        ];

        return view('games.list', [
            'games' => $games,
            'bestGames' => $bestGames,
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
