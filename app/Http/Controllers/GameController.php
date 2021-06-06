<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        $games = DB::table('games')
            ->join('genres', 'games.genre_id', '=', 'genres.id')
            ->select('games.id', 'games.title', 'games.score', 'genres.name as genre_name')
            ->orderByDesc('score')
//            ->limit(10)
//            ->offset(2)
              ->paginate(10);
              //->simplePaginate();

        return view('games.list', ['games' => $games]);
    }

    public function dashboard(): View
    {
        $bestGames = DB::table('games')
            ->join('genres', 'games.genre_id', '=', 'genres.id')
            ->select('games.id', 'games.title', 'games.score', 'genres.name as genre_name')
            ->where('score', '>', 7)
            ->orderBy('score', 'desc')
            ->limit(10)
            ->get();

        $stats = [
            'count' => DB::table('games')->count(),
            'countScoreGtSeven' => DB::table('games')->where('score', '>', 7)->count(),
            'max' => DB::table('games')->max('score'),
            'min' => DB::table('games')->min('score'),
            'avg' => DB::table('games')->avg('score')
        ];

        $scoreStats = DB::table('games')
            ->select(DB::raw('count(*) as count'),'score')
            ->having('count', '>', 8)
            ->groupBy('score')
            ->orderBy('count', 'desc')
            ->get();

        return view('games.dashboard', [
            'bestGames' => $bestGames,
            'stats' => $stats,
            'scoreStats' => $scoreStats
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
