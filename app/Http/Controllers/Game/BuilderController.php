<?php

namespace App\Http\Controllers\Game;

use App\Repository\GameRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class BuilderController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository)
    {
        dump(get_class($repository));
        $this->gameRepository = $repository;
    }

    public function index(): View
    {
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

    public function show(int $gameId): View
    {
        return view('games.show', [
            'game' => $this->gameRepository->get($gameId)
        ]);
    }
}
