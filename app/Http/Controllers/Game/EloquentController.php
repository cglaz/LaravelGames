<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Model\Game;

class EloquentController extends Controller
{
    public function index(): View
    {
        $games = Game::orderByDesc('created_at')
        ->paginate(10);

        return view('games.eloquent.list', ['games' => $games]);
    }

    public function dashboard(): View
    {
        $bestGames = Game::where('score', '>', 7)
            ->get();

        $stats = [
            'count' => Game::count(),
            'countScoreGtSeven' => Game::where('score', '>', 7)->count(),
            'max' => Game::max('score'),
            'min' => Game::min('score'),
            'avg' => Game::avg('score')
        ];

        $scoreStats = Game::select(
            DB::raw('count(*) as count'),'score'
        )
            ->having('count', '>', 8)
            ->groupBy('score')
            ->orderBy('count', 'desc')
            ->get();

        return view('games.eloquent.dashboard', [
            'bestGames' => $bestGames,
            'stats' => $stats,
            'scoreStats' => $scoreStats
        ]);
    }

    public function show(int $gameId): View
    {
        $game = Game::find($gameId);
        //$game = Game::where('id', $gameId)->first();
        //$game = Game::firstWhere('id', $gameId);
        //$game = Game::findOrFail($gameId);

        return view('games.eloquent.show', [
            'game' => $game
        ]);
    }
}
