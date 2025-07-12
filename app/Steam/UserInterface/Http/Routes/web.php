<?php

use App\Steam\UserInterface\Http\Controllers\CreatePlayerController;
use App\Steam\UserInterface\Http\Controllers\UpdatePlayerGamesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/player/{steam_name}', CreatePlayerController::class);
Route::put('/player/{steam_id}/games', UpdatePlayerGamesController::class);
