<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MissionController;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});
Route::get('/missions', [MissionController::class, 'index'])->name('missions');


// API 
Route::post('/api/login', [ApiController::class, 'login']);
Route::post('/api/register', [ApiController::class, 'register']);
Route::get('/api/mission-progress', [ApiController::class, 'checkProgress']);
Route::post('/api/update-progress', [ApiController::class, 'updateProgress']);
Route::post('/api/upload-image', [ApiController::class, 'uploadImage']);
Route::post('/logout', [ApiController::class, 'logout'])->name('logout');

Route::get('/check-session', function () {
    return response()->json([
        'authenticated' => session()->has('api_token'),
        'api_token'     => session('api_token'),
    ]);
});
