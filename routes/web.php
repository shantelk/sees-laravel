<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MissionController;

Route::get('/', [MissionController::class, 'showMissions'])->name('home');

