<?php

namespace App\Http\Controllers\Game;


use App\Http\Controllers\Controller;
use App\Repository\GameRepository;
use App\Service\FakeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use App\Model\Game;

class GameController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository)
    {

        $this->gameRepository = $repository;
    }

    public function index(): View
    {
        Log::alert('to je fasada');
        return view('games.list', ['games' => $this->gameRepository->allPaginated(12)]);
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
        return view('games.show', [
            'game' => $this->gameRepository->get($gameId)
        ]);
    }
}
