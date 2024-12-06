<?php

use Illuminate\Http\Request;
use function Pest\Laravel\post;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/games', [GameController::class, 'index']);
Route::post('/games/{game}/join', [GameController::class, 'join']);
Route::post('/games/{game}/leave', [GameController::class, 'leave']);
