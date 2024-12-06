<?php

namespace App\Http\Controllers;

use App\Events\GamesUpdated;
use App\Models\Games;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    //
    public function index(): JsonResponse
    {
        return response()->json(Games::withCount('users as player_count')->get());
    }

    public function join(Games $game): JsonResponse
    {
        if ($game->users()->count() >= $game->max_players) {
            return response()->json(['message' => 'Game is full'], 400);
        }

        $game->users()->syncWithoutDetaching(auth()->user());

        broadcast(new GamesUpdated);

        return response()->json($game);
    }

    public function leave(Games $game): JsonResponse
    {
        $game->users()->detach(auth()->user());

        broadcast(new GamesUpdated);

        return response()->json($game);
    }
}
