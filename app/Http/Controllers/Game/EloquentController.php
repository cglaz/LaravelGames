<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\View\View;
use App\Model\Game;

class EloquentController extends Controller
{
    public function index(): View
    {
        $games = Game::with('genre')
            //->publisher('Edios')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('games.eloquent.list', ['games' => $games]);
    }

    public function dashboard(): View
    {
        $bestGames = Game::best()->get();

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

    public function show(int $gameId, Request $request): View
    {
        $isAjax = false;
        if($request->ajax()) {
            $isAjax = true;
        }

        $game = Game::find($gameId);

        if($isAjax) {
            return $game;
        } else {
            return view('games.eloquent.show', [
                'game' => $game
            ]);
        }

    }
}
