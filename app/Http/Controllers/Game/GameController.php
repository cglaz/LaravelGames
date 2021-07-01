<?php

namespace App\Http\Controllers\Game;

use App\Facade\Game;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repository\GameRepository;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository)
    {
        $this->gameRepository = $repository;
    }

    public function index(): View
    {
        return view('game.list', [
            'games' => $this->gameRepository->allPaginated(10)
        ]);
    }

    public function dashboard(): View
    {


        return view('games.dashboard', [
            'bestGames' => $this->gameRepository->best(),
            'stats' => $this->gameRepository->stats(),
            'scoreStats' => $this->gameRepository->scoreStats()
        ]);
    }

    public function show(int $gameId, Request $request): View
    {
        return view('game.show', [
            'game' => $this->gameRepository->get($gameId)
        ]);
    }
}
