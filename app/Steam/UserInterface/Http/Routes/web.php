<?php

use App\Steam\UserInterface\Http\Controllers\CreatePlayerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/player/{steam_name}', CreatePlayerController::class);
