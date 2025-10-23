<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MissionController;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});
Route::get('/missions', [MissionController::class, 'showMissions'])->name('missions');



// API 
Route::post('/api/submit-email', [ApiController::class, 'submitEmail']);
Route::get('/api/mission-progress', [ApiController::class, 'checkProgress']);
Route::post('/api/update-progress', [ApiController::class, 'updateProgress']);
Route::post('/logout', [ApiController::class, 'logout'])->name('logout');


Route::post('/api/upload-image', [ApiController::class, 'uploadImage']);
